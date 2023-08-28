<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadedFile;
use PhpOffice\PhpWord\IOFactory;
use Auth;
use PhpOffice\PhpWord\PhpWord;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
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

        return 'No document uploaded.';
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
        // Create a new instance of PhpWord
        $phpWord = new PhpWord();

        $section = $phpWord->addSection();

        $htmlContent = $request->editor;
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlContent, false, false);
        $filePath = public_path('generated_document.docx');
        $phpWord->save($filePath, "Word2007");
        return response()->download($filePath)->deleteFileAfterSend(true);

    }

}
