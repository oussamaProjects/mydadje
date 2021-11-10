<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Category;
use App\Department;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FolderController extends Controller
{

    public function __construct()
    {
        // return $this->middleware(['auth', 'permission:manage']);
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folders = $folders_table = Folder::where('parent_id', '=', '0')->get();
        $folders_input = Folder::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        $depts = Department::all();
        $docs = null;
        $user = auth()->user();

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
        // dd($folders);
        return view('folders.index', compact('folders', 'folders_input', 'folders_table', 'docs', 'depts', 'categories'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {

        $folders_input = Folder::pluck('name', 'id')->all();
        $folders_table = $folders = Folder::all();
        $categories = Category::pluck('name', 'id')->all();
        $depts = Department::all();
        $docs = null;
        $user = auth()->user();

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
        // dd($folders);
        return view('folders.all', compact('folders', 'folders_input', 'folders_table', 'docs', 'depts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $folder = new Folder;
        $user_id = auth()->user()->id;
        $department_id = auth()->user()->department_id;

        $check_name = Folder::where('name', '=', $request->input('name'))->first();
        if ($check_name !== null) {
            return redirect()->back()->with('failure', 'Le nom du dossier exist deja !');
        }

        $folder->name = $request->input('name');
        $folder->user_id = $user_id;
        $folder->department_id = $department_id;

        if ($request->input('parent'))
            $folder->parent_id = !is_numeric($request->input('folder_parent_id')) ?  0 : $request->input('folder_parent_id');

        // save to db
        $folder->save();

        \Log::addToLog('New folder ' . $request->input('name') . ' was added');

        return redirect('/folders')->with('success', 'Le dossier a été ajouté avec succès !');
    }

    // searching
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string',
        ]);

        $srch = strtolower($request->input('search'));
        $names = Folder::pluck('name')->all();
        $results = [];

        for ($i = 0; $i < count($names); $i++) {
            $lower = strtolower($names[$i]);
            if (strpos($lower, $srch) !== false) {
                $results[$i] = Folder::where('name', $names[$i])->get();
            }
        }

        return view('folders.results', compact('results'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {

        $user = auth()->user();
        $folders = Folder::where('parent_id', '=', '0')->get();
        $folders_table = Folder::where('parent_id', '=', $folder->id)->get();
        $categories = Category::pluck('name', 'id')->all();
        $depts = Department::all();
        $folders_input = Folder::pluck('name', 'id')->all();
        $docs = $folder->documents()->get();
        $filetype = '';


        if ($this->has_permission_for_folder($folder->id, $user))
            return view('documents.index', compact('docs', 'folder', 'folders', 'folders_table', 'folders_input', 'filetype', 'depts', 'categories'));
        else
            return redirect('/documents')->with('failure', 'vous n\'avez pas accès à ce dossier');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function child(int $id)
    {

        $user = auth()->user();
        $folders = Folder::where('parent_id', '=', '0')->get();
        $folders_table = Folder::where('parent_id', '=', $id)->get();
        $categories = Category::pluck('name', 'id')->all();
        $depts = Department::all();
        $folders_input = Folder::pluck('name', 'id')->all();

        $folder = Folder::findOrFail($id);
        $docs = $folder->documents()->get();
        $filetype = '';

        if ($this->has_permission_for_folder($id, $user))
            return view('folders.index', compact('docs', 'folder', 'folders', 'folders_table', 'folders_input', 'filetype', 'depts', 'categories'));
        else
            return redirect('/folders')->with('failure', 'vous n\'avez pas accès à ce dossier');
    }



    function has_permission_for_folder($id, $user)
    {
        $permission = DB::table('departments')
            ->leftJoin('folder_departement', 'folder_departement.department_id', 'departments.id')
            ->where('folder_departement.folder_id', '=', $id)
            ->where('folder_departement.department_id', '=', $user->department_id)
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
            return false;
        }

        return true;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        // $folder = Folder::findOrFail($folder);
        $user = auth()->user();
        $depts              = Department::all();
        // dd($depts);
        $document_departement = 0;

        foreach ($depts as $key => $dept) {

            $dp = DB::table('folder_departement')
                ->select('folder_departement.folder_id', 'folder_departement.department_id', 'folder_departement.permission_for')
                ->where('folder_departement.folder_id', '=', $folder->id)
                ->where('folder_departement.department_id', '=', $dept['id'])
                ->get()
                ->toArray();

            if (isset($dp) && !empty($dp)) {
                $folder_departement = $dp[0];
                $dept['permission_for'] = isset($folder_departement->permission_for) ? $folder_departement->permission_for : 0;
            }
        }

        if ($user->hasRole('Root'))
            return view('folders.edit', compact('folder', 'depts'));
        else
            return redirect('/folders')->with('failure', 'Vous ne pouvez pas modifier ce dossier');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|required',
        ]);

        $depts = Department::all();
        $permissions = [];

        $folder = Folder::findOrFail($id);
        $folder->name = $request->input('name');
        $folder->save();


        foreach ($depts as $dep) {
            $permissions[] = $request->input('permissions_' . $dep->id);
        }

        $folder->department()->detach();
        foreach ($permissions as $key => $permission) {
            if ($permission !== null) {

                $perms = explode('_', $permission[0]);


                // $doc->department()->sync($perms[0]);
                $folder->department()->attach($folder->id, [
                    'department_id' => $perms[0],
                    'permission_for' => ($perms[1] != 'all') ? 1 : 0
                ]);
            }
        }

        \Log::addToLog('Folder ID ' . $id . ' was edited');

        return redirect('folders')->with('success', 'Le dossier a été mis à ajour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->hasRole('Root')) {
            $folder = Folder::find($id);

            $folder->delete();

            $folder->documents()->detach();

            \Log::addToLog('Folder ID ' . $id . ' was deleted');

            return redirect()->back()->with('success', 'Le dossier a été supprimé avec succès !');
        } else
            return redirect()->back()->with('failure', 'Vous ne pouvez pas supprimé ce dossier');
    }

    public function changeColor(Request $request, $id)
    {
        $folder = Folder::findOrFail($id);
        $folder->color =  $request->input('color');
        $folder->save();

        return redirect()->back()->with('success', 'La couleur du dossier a été modifie avec succès !');
    }
}
