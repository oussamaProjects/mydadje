<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Category;
use App\Department;
use App\Folder;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Arr;

class DocumentsController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasRole('Root')) {
      // get all
      $docs = Document::where('isExpire', '!=', 2)->get();
    } else {
      // get user's docs
      // $user_id = auth()->user()->id;

      // $docs = Document::where('user_id',$user_id)->get();

      // get docs in dept
      $dept_id = auth()->user()->department_id;

      $docs = Document::where('isExpire', '!=', 2)->where('user_id', '!=', auth()->user()->id)->get();
      // $docs = Document::where('isExpire', '!=', 2)->where('department_id', $dept_id)->where('user_id', '!=', auth()->user()->id)->get();
    }
    $filetype = null;
    $user = auth()->user();
    $folders  = Folder::where('parent_id', '=', '0')->get();
    $folders_input = Folder::pluck('name', 'id')->all();
    $categories = Category::pluck('name', 'id')->all();
    $depts = Department::all();

    foreach ($folders as $key => $folder) {
      $dp = DB::table('departments')
        ->leftJoin('folder_departement', 'folder_departement.department_id', 'departments.id')
        ->where('folder_departement.folder_id', '=', $folder->id)
        ->where('folder_departement.department_id', '=', $user->department_id)
        ->distinct()
        ->get();

      if (isset($dp) && !empty($dp[0])) {
        $folder_departement = $dp[0];
        $folder['permission_for'] = isset($folder_departement->permission_for) ? $folder_departement->permission_for : 0;
      }
    }
    return view('documents.index', compact('docs', 'filetype', 'folders', 'folders_input', 'categories', 'depts'));
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function all()
  {

    if (auth()->user()->hasRole('Root')) {
      $docs = Document::where('isExpire', '!=', 2)->paginate(1);
    } else {
      $dept_id = auth()->user()->department_id;
      $docs = Document::where('isExpire', '!=', 2)->paginate(1);
    }
    $filetype = null;
    $folders_input = Folder::pluck('name', 'id')->all();
    $categories = Category::pluck('name', 'id')->all();
    $depts = Department::all();

    return view('documents.all', compact('docs', 'filetype', 'folders_input', 'categories', 'depts'));
  }

  // my documents
  public function mydocuments()
  {
    // get user's docs
    $user_id = auth()->user()->id;

    $docs = Document::where('user_id', $user_id)->get();

    return view('documents.mydocuments', compact('docs'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::pluck('name', 'id')->all();
    $folders = Folder::pluck('name', 'id')->all();
    $depts = Department::all();

    return view('documents.create', compact('categories', 'folders', 'depts'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $depts = Department::all();
    $permissions = [];

    foreach ($depts as $dep) {
      $permissions[] = $request->input('permissions_' . $dep->id);
    }

    $this->validate($request, [
      'name' => 'required|string|max:255',
      'description' => 'required|string|max:255',
      'file' => 'required|max:50000',
    ]);

    // get the data of uploaded user
    $user_id = auth()->user()->id;
    $department_id = auth()->user()->department_id;
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
      $path = $request->file('file')->storeAs('public/files/' . $user_id, $fileNameToStore);
    }

    $doc = new Document;
    $check_name = Document::where('name', 'like', $request->input('name'))->first();
    if ($check_name !== null) {
      return redirect()->back()->with('failure', 'Le nom du fichier exist deja !');
    }

    $check_ref = Document::where('ref', 'like', $request->input('ref'))->first();
    if ($check_ref !== null) {
      return redirect()->back()->with('failure', 'La réference exist deja !');
    }

    $check_ver = Document::where('version', 'like', $request->input('version'))->first();
    if ($check_ver !== null) {
      return redirect()->back()->with('failure', 'Le version exist deja !');
    }

    $doc->name = $request->input('name');
    $doc->description = $request->input('description');
    $doc->ref = $request->input('ref');
    $doc->version = $request->input('version');
    $doc->user_id = $user_id;
    $doc->department_id = $department_id;
    $doc->file = $path;
    $doc->mimetype = Storage::mimeType($path);
    $size = Storage::size($path);
    if ($size >= 1000000) {
      $doc->filesize = round($size / 1000000) . 'MB';
    } elseif ($size >= 1000) {
      $doc->filesize = round($size / 1000) . 'KB';
    } else {
      $doc->filesize = $size;
    }
    // determine whether it expires
    if ($request->input('isExpire') == true) {
      $doc->isExpire = false;
    } else {
      $doc->isExpire = true;
      $doc->expires_at = $request->input('expires_at');
    }

    // save to db
    $doc->save();
    // add Category
    $doc->categories()->sync($request->category_id);
    // add Folder
    $doc->folders()->sync($request->folder_id);

    foreach ($permissions as $key => $permission) {
      if ($permission !== null) {
        $perms = explode('_', $permission[0]);
        // echo '<pre>';
        // var_dump($perms);
        // var_dump($doc->id);
        // echo '</pre>';
        $doc->department()->attach($doc->id, [
          'department_id' => $perms[0],
          'permission_for' => ($perms[1] != 'all') ? 1 : 0
        ]);
      }
    }

    \Log::addToLog('New Document, ' . $request->input('name') . ' was uploaded');

    return redirect()->back()->with('success', 'Le fichier a été téléchargé avec succès !');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $doc = Document::findOrFail($id);
    $doc_id = $doc->id;
    $category_id = $doc->categories()->first()->id;
    $user = auth()->user();

    $permission = DB::table('departments')
      ->leftJoin('document_departement', 'document_departement.department_id', 'departments.id')
      ->where('document_departement.document_id', '=', $id)
      ->where('document_departement.department_id', '=', $user->department_id)
      ->distinct()
      ->get();

    // if (!$user->hasRole('Root')) {
    //   // var_dump($user->department_id);
    //   // var_dump($id);
    //   // var_dump($permission[0]->permission_for);
    //   if (!is_null($permission)) {
    //     if ($user->hasRole('Admin')) {
    //       if ($permission[0]->permission_for == 1 || $permission[0]->permission_for == 0)
    //         return view('documents.show', compact('doc'));
    //       else
    //         return redirect('/documents')->with('Do not have acces to view this file', 'File Uploaded');
    //     } else if ($user->hasRole('User')) {
    //       if ($permission[0]->permission_for == 0)
    //         return view('documents.show', compact('doc'));
    //       else
    //         return redirect('/documents')->with('Do not have acces to view this file', 'File Uploaded');
    //     } else
    //       return redirect('/documents')->with('Do not have acces to view this file', 'File Uploaded');
    //   }
    // } 

    $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($doc->file);
    $path = Storage::disk('public')->path($doc->file);
    $path = Storage::url($doc->file);
    $docID = $doc->id;
    // get previous user id
    $previous = Document::whereHas('categories', function ($query) use ($doc_id, $category_id) {
      $query->where('document.id', '<', $doc_id);
      $query->where('category.id', $category_id);
    })->max('id');
    // get next user id

    $next = Document::whereHas('categories', function ($query) use ($doc_id, $category_id) {
      $query->where('document.id', '>', $doc_id);
      $query->where('category.id', $category_id);
    })->min('id');


    if ($this->has_permission($id, $user))
      return view('documents.show', compact('doc', 'path', 'previous', 'next'));
    else
      return redirect('/documents')->with('failure', 'Vous ne pouvez pas voir ce document');
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $doc                = Document::findOrFail($id);
    $selectedCategories = $doc->categories->pluck('id');
    $selectedFolders    = $doc->folders->pluck('id');

    $categories         = Category::pluck('name', 'id')->all();
    $folders            = Folder::pluck('name', 'id')->all();
    $depts              = Department::all();


    // dd($depts);
    $document_departement = 0;

    foreach ($depts as $key => $dept) {

      $dp = DB::table('document_departement')
        ->select('document_departement.document_id', 'document_departement.department_id', 'document_departement.permission_for')
        ->where('document_departement.document_id', '=', $id)
        ->where('document_departement.department_id', '=', $dept['id'])
        ->get()
        ->toArray();

      if (isset($dp) && !empty($dp)) {
        $document_departement = $dp[0];
        $dept['permission_for'] = isset($document_departement->permission_for) ? $document_departement->permission_for : 0;
      }
    }

    // dd($depts);
    return view('documents.edit', compact('doc', 'categories', 'folders', 'depts', 'selectedCategories', 'selectedFolders'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {

    $this->validate($request, [
      'name' => 'required|string|max:255',
      'description' => 'required|string|max:255'
    ]);

    $depts = Department::all();
    $permissions = [];

    $doc = Document::findOrFail($id);

    $check_name = Document::where('name', 'like', $request->input('name'))->where('id', '!=', $id)->first();
    if ($check_name !== null) {
      return redirect()->back()->with('failure', 'Le nom du fichier exist deja !');
    }

    $check_ref = Document::where('ref', 'like', $request->input('ref'))->where('id', '!=', $id)->first();
    if ($check_ref !== null) {
      return redirect()->back()->with('failure', 'La réference exist deja !');
    }

    $check_ver = Document::where('version', 'like', $request->input('version'))->where('id', '!=', $id)->first();
    if ($check_ver !== null) {
      return redirect()->back()->with('failure', 'Le version exist deja !');
    }

    $doc->name = $request->input('name');
    $doc->description = $request->input('description');
    // determine whether it expires
    if ($request->input('isExpire') == true) {
      $doc->isExpire = false;
      $doc->expires_at = null;
    } else {
      $doc->isExpire = true;
      $doc->expires_at = $request->input('expires_at');
    }
    $doc->save();

    // add Category
    $doc->categories()->sync($request->category_id);
    // add Folder
    $doc->folders()->sync($request->folder_id);

    foreach ($depts as $dep) {
      $permissions[] = $request->input('permissions_' . $dep->id);
    }

    $doc->department()->detach();
    foreach ($permissions as $key => $permission) {
      if ($permission !== null) {

        $perms = explode('_', $permission[0]);


        // $doc->department()->sync($perms[0]);
        $doc->department()->attach($doc->id, [
          'department_id' => $perms[0],
          'permission_for' => ($perms[1] != 'all') ? 1 : 0
        ]);
      }
    }

    \Log::addToLog('Document ID ' . $id . ' was edited');

    return redirect('/documents')->with('success', 'Le fichier a été mis à jour avec succès !');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = auth()->user();
    if ($user->hasRole('Root')) {
      $doc = Document::findOrFail($id);
      // delete the file on disk
      Storage::delete($doc->file);
      // delete db record
      $doc->delete();
      // delete associated categories
      $doc->categories()->detach();

      \Log::addToLog('Document ID ' . $id . ' was deleted');

      return redirect('/documents')->with('success', 'Le fichier a été supprimé avec succès !');
    } else
      return redirect('/documents')->with('failure', 'Vous ne pouvez pas supprimé ce document');
  }

  // delete multiple docs selected
  public function deleteMulti(Request $request)
  {
    $user = auth()->user();
    if (!$user->hasRole('Root')) {
      $ids = $request->ids;
      DB::table('document')->whereIn('id', explode(',', $ids))->delete();

      \Log::addToLog('Selected Documents Are Deleted!');

      return redirect('/documents')->with('success', 'Les documents sélectionnés ont été supprimés !');
    } else
      return redirect('/documents')->with('failure', 'Vous ne pouvez pas supprimé les documents sélectionnés');
  }

  // opening file
  public function open($id)
  {
    $user = auth()->user();
    // find trashed documents
    // if ($user->hasRole('Root')) {

    if ($this->has_permission($id, $user)) {
      $doc = Document::findOrFail($id);
      $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($doc->file);
      $type = $doc->mimetype;

      \Log::addToLog('Document ID ' . $id . ' was viewed');

      if (
        $type == 'application/pdf' || $type == 'image/jpeg' ||
        $type == 'image/png' || $type == 'image/jpg' || $type == 'image/gif'
      ) {
        return response()->file($path, ['Content-Type' => $type]);
      } elseif (
        $type == 'video/mp4' || $type == 'audio/mpeg' ||
        $type == 'audio/mp3' || $type == 'audio/x-m4a'
      ) {
        return view('documents.play', compact('doc'));
      } else {
        return response()->file($path, ['Content-Type' => $type]);
      }
    }
    return redirect()->back()->with('failure', 'Vous ne pouvez pas ouvrir ce document');
  }

  // download file
  public function download($id)
  {
    $user = auth()->user();
    // find trashed documents
    if ($user->hasRole('Root')) {
      $doc = Document::findOrFail($id);
      $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($doc->file);
      $type = $doc->mimetype;

      \Log::addToLog('Document ID ' . $id . ' was downloaded');

      // return response()->download($path, $doc->name, ['Content-Type:' . $type]);
      return response()->download($path);
    }
    return redirect()->back()->with('failure', 'Vous ne pouvez pas telecharger ce document');
  }

  // searching
  public function search(Request $request)
  {
    $this->validate($request, [
      'search' => 'required|string'
    ]);

    $srch = strtolower($request->input('search'));
    $names = Document::pluck('name')->all();
    $results = [];

    for ($i = 0; $i < count($names); $i++) {
      $lower = strtolower($names[$i]);
      if (strpos($lower, $srch) !== false) {
        $results[$i] = Document::where('name', $names[$i])->get();
      }
    }
    return view('documents.results', compact('results'));
  }

  // sorting
  public function sort(Request $request)
  {
    $filetype = $request->input('filetype');

    $docs     = Document::where('mimetype', $filetype)->get();
    $folders  = Folder::where('parent_id', '=', '0')->get();
    $user     = auth()->user();

    $folders_input = Folder::pluck('name', 'id')->all();
    $categories = Category::pluck('name', 'id')->all();
    $depts = Department::all();

    foreach ($folders as $key => $folder) {
      $dp = DB::table('departments')
        ->leftJoin('folder_departement', 'folder_departement.department_id', 'departments.id')
        ->where('folder_departement.folder_id', '=', $folder->id)
        ->where('folder_departement.department_id', '=', $user->department_id)
        ->distinct()
        ->get();

      if (isset($dp) && !empty($dp[0])) {
        $folder_departement = $dp[0];
        $folder['permission_for'] = isset($folder_departement->permission_for) ? $folder_departement->permission_for : 0;
      }
    }

    return view('documents.index', compact('docs', 'filetype', 'folders', 'folders_input', 'categories', 'depts'));
  }

  public function trash()
  {
    // make expired documents
    $docs = Document::where('isExpire', 1)->get();
    $today = Date('Y-m-d');

    foreach ($docs as $d) {
      if ($today > $d->expires_at) {
        $maketrash = Document::findOrFail($d->id);
        $maketrash->isExpire = 2;
        $maketrash->save();
      }
    }
    // find out auth user role
    $user = auth()->user();
    // find trashed documents
    if ($user->hasRole('Root')) {
      $trash = Document::where('isExpire', 2)->get();
    } elseif ($user->hasRole('Admin')) {
      $trash = Document::where('isExpire', 2)->where('department_id', $user->department_id)->get();
    } else {
      $trash = Document::where('isExpire', 2)->where('user_id', $user->id)->get();
    }

    return view('documents.trash', compact('trash'));
  }

  public function restore($id)
  {
    $restoreDoc = Document::findOrFail($id);
    $restoreDoc->isExpire = 0;
    $restoreDoc->expires_at = null;
    $restoreDoc->save();

    return redirect()->back()->with('success', 'Le fichier a été restauré avec succès !');
  }

  public function changeColor(Request $request, $id)
  {
    $doc = Document::findOrFail($id);
    $doc->color =  $request->input('color');
    $doc->save();

    return redirect()->back()->with('success', 'La couleur du fichier a été modifie avec succès !');
  }

  function has_permission($id, $user)
  {
    $permission = DB::table('departments')
      ->leftJoin('document_departement', 'document_departement.department_id', 'departments.id')
      ->where('document_departement.document_id', '=', $id)
      ->where('document_departement.department_id', '=', $user->department_id)
      ->distinct()
      ->get();
    if (!$user->hasRole('Root')) {
      // var_dump($user->department_id);
      // var_dump($id);
      // var_dump($permission[0]->permission_for);
      if (isset($permission[0]) && !is_null($permission[0])) {
        if ($user->hasRole('Admin')) {
          if ($permission[0]->permission_for == 1 || $permission[0]->permission_for == 0)
            return true;
          else
            return false;
        } else if ($user->hasRole('User')) {
          if ($permission[0]->permission_for == 0)
            return true;
          else
            return false;
        } else
          return false;
      }
    }

    return true;
  }
}
