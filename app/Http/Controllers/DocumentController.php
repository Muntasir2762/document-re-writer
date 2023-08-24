<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadedFile;
use PhpOffice\PhpWord\IOFactory;
use Auth;

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
            // Convert DOC to HTML

            //return "File Uploaded Successfully";
            //return redirect("/view/$fileName");
        }

        return 'No document uploaded.';
    }

    protected function convertDocToHtml($filename)
    {
        //dd(public_path("uploads/$filename"));
        $doc = IOFactory::load(public_path("uploads/$filename"));
        //dd($doc);
        $htmlContent = '';

        foreach ($doc->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                //dd($element->getText());
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    //dd($element instanceof \PhpOffice\PhpWord\Element\TextRun);
                    //$htmlContent .= '<p>' . $element->getText() . '</p>';
                    $htmlContent .= '<p>' . 'Hello' . '</p>';
                }
                // You can handle images, formatting, lists, etc., similarly
            }
        }

        return $htmlContent;
    }

    public function viewFile($filename)
    {
        //$docUrl = "https://docs.google.com/viewer?url=" . urlencode(asset("uploads/$filename"));
        $docUrl = "";
        //dd($docUrl);
        return view('upload.view-file', compact('docUrl'));
    }
}
