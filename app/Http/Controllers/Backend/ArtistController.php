<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Backend\Artist;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
class ArtistController extends Controller
{
    use Authorizable;

    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Artists';

        // module name
        $this->module_name = 'artists';

        // directory path of the module
        $this->module_path = 'backend.artists';

        // module icon
        $this->module_icon = 'artist';

        // module model name, path
        // $this->module_model = "Modules\Tag\Entities\Tag";
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        // $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';
        
        if ($request->ajax()) {
            $data = Artist::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="view btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" data-id="'.$row->id.'">V</a>';
                        $btn .= '&nbsp;&nbsp;';
                        $btn .= '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" data-id="'.$row->id.'">E</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view($module_path.'.index', compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:artists|max:255',
            'status' => 'required:in:active,inactive',
            'is_featured' => 'required:in:yes,no',
        ]);

        $artist = Artist::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'website' => $request->website,
            'bio' => $request->bio,
            'status' => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        if ($artist) {
            return response()->json(['success' => 'Artist created successfully']);
        } else {
            return response()->json(['error' => 'Artist creation failed']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
        $artist = Artist::with('user_created')->with('user_updated')->findorfail($id);
        return response()->json($artist);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $artist = Artist::findorfail($id);
        return response()->json($artist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|max:255|unique:artists,name,'.$id.',id',           
            'status' => 'required:in:active,inactive',
            'is_featured' => 'required:in:yes,no',
        ]);

        $artist = Artist::findorfail($id);

        $artist->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'website' => $request->website,
            'bio' => $request->bio,
            'status' => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        if ($artist) {
            return response()->json(['success' => 'Artist updated successfully']);
        } else {
            return response()->json(['error' => 'Artist updation failed']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete artist and save to soft delete
        $artist = Artist::findorfail($id);
        $artist->delete();

        if ($artist) {
            return response()->json(['success' => 'Artist deleted successfully']);
        } else {
            return response()->json(['error' => 'Artist deletion failed']);
        }
    }
}
