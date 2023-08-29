<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadedFile;
use PhpOffice\PhpWord\IOFactory;
use Auth;
use Carbon\Carbon;
use PhpOffice\PhpWord\PhpWord;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        $user = Auth::user();
        if($user->is_blocked != true){
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);

                $uploadFile = new UploadedFile();
                $uploadFile->user_id = Auth::user()->id;
                $uploadFile->file_name = $fileName;
                $uploadFile->save();

                // Convert DOC to HTML
                $htmlContent = $this->convertDocToHtml($fileName);


                return view('upload.editor', compact('htmlContent'));
            }
            else{
                return 'No document uploaded.';
            }
        }
        toastr()->error('You are temporarily blocked!!');
        return redirect()->back();
    }

    protected function convertDocToHtml($filename)
    {
        $content = '';
        $phpWord = IOFactory::load(public_path("uploads/$filename"));

        foreach($phpWord->getSections() as $section) {
            foreach($section->getElements() as $element) {
                if (method_exists($element, 'getElements')) {
                    foreach($element->getElements() as $childElement) {
                        if (method_exists($childElement, 'getText')) {
                            $content .= $childElement->getText() . ' ';
                        }
                        else if (method_exists($childElement, 'getContent')) {
                            $content .= $childElement->getContent() . ' ';
                        }
                    }
                }
                else if (method_exists($element, 'getText')) {
                    $content .= $element->getText() . ' ';
                }
            }
        }
        return $content;
    }

    public function editedContent (Request $request)
    {
        $user = Auth::user();

        if($user->is_blocked != true){
            // Create a new instance of PhpWord
            $phpWord = new PhpWord();

            $section = $phpWord->addSection();

            $htmlContent = $request->editor;
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlContent, false, false);
            $filePath = public_path('generated_document.docx');
            $phpWord->save($filePath, "Word2007");

            //Record File Processing...
            if($user->limit_updated_at == null){
                $user->limit_updated_at = Carbon::now();
                $user->save();
            }
            $limit_updated_at = Carbon::parse($user->limit_updated_at);
            if($limit_updated_at <= $limit_updated_at->addMinutes(10)){
                $user->limit_updated_at = Carbon::now();
                $user->limit_count = $user->limit_count+1;
                $user->save();
            }

            if(($user->limit_count >=3) && ($user->limit_updated_at <= $user->limit_updated_at->addMinutes(10))){
                $user->is_blocked = true;
                $user->save();
            }
            return response()->download($filePath)->deleteFileAfterSend(true);
            //Record File Processing...
        }

        else{
            toastr()->error('You are temporarily blocked!!');
            return redirect('/home');
        }

    }

}
