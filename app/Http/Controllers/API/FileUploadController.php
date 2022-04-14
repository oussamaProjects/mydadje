<?php

namespace App\Http\Controllers\API;

use App\Document;
use App\Helpers\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255', 
            'file' => 'required|max:50000',
        ]); 
        // handle file upload
        if ($request->hasFile('file')) {
            // filename with extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            // filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // extension
            $extension = $request->file('file')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload file
            $path = $request->file('file')->storeAs('public/files/' . $request->client_id . '/' . $request->affaire_id, $fileNameToStore);
        }

        $doc = new Document;
        $check_name = Document::where('name', 'like', $request->input('name'))->first();
        if ($check_name !== null) {
            return redirect()->back()->with('failure', 'Le nom du fichier exist deja !');
        }



        $doc->name = $request->input('name');
        $doc->description = "#" . $request->client_id . '-' . $request->affaire_id;
        $doc->ref = "#" . $request->client_id . '-' . $request->affaire_id;
        $doc->version = 1;
        $doc->archived = 0;
        $doc->validated = 0;
        $doc->user_id = 1;
        $doc->department_id = 0;
        $doc->file = $path;
        $doc->color =  '#fdf4d0';
        $doc->mimetype = Storage::mimeType($path);
        $size = Storage::size($path);

        if ($size >= 1000000) {
            $doc->filesize = round($size / 1000000) . 'MB';
        } elseif ($size >= 1000) {
            $doc->filesize = round($size / 1000) . 'KB';
        } else {
            $doc->filesize = $size;
        }

        // save to db
        $doc->save();
        // add Category
        $doc->categories()->sync(0);
        // add Folder
        $doc->folders()->sync(0);

        // dd($permissions);
        // UtilityController::attachDocToDept($doc, $permissions);

        Log::addToLog('New Document from extern, ' . $request->input('name') . ' was uploaded');

        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "doc" => $doc
        ]);
    }
}
