<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Backend\SongCategory;
use App\Http\Requests\SongCategoryRequest;

class SongCategoryController extends Controller
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
        $this->module_title = 'Song Categories';

        // module name
        $this->module_name = 'song_categories';

        // directory path of the module
        $this->module_path = 'backend.song_categories';

        // module icon
        $this->module_icon = 'song_categories';

        // module model name, path
        // $this->module_model = "Modules\Tag\Entities\Tag";
    }
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request )
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
            $data = SongCategory::latest()->with('parent', 'children')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="view btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" data-id="'.$row->id.'">V</a>';
                        $btn .= '&nbsp;&nbsp;';
                        $btn .= '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" data-id="'.$row->id.'">E</a>';
                        return $btn;
                    })
                    ->editColumn('updated_at', function ($data) {
                        $module_name = $this->module_name;
        
                        $diff = Carbon::now()->diffInHours($data->updated_at);
        
                        if ($diff < 25) {
                            return $data->updated_at->diffForHumans();
                        } else {
                            return $data->updated_at->isoFormat('LLLL');
                        }
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
    public function store(SongCategoryRequest $request)
    {
        // check request is valid
        if ($request->validated()) {
            // store data
            $song_category = SongCategory::create(
                [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'status' => $request->status,
                    'description' => $request->desc,
                    'parent_id' => $request->parent_id ? $request->parent_id : 0,
                    'order' => $request->order,
                    'is_featured' => $request->is_featured,
                    'is_special' => $request->is_special,
                ]
            );
            // check if song_category created
            if ($song_category) {
                // send notification
                return response()->json(['success' => 'Song Category created successfully.']);
            } else {
                // send notification
                return response()->json(['error' => 'Song Category could not be created.']);
            }
        } else {
            // send notification
            return response()->json(['error' => 'Song Category could not be created.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $song_category = SongCategory::with('parent', 'children', 'user')->findOrFail($id);
        // edit created_at for human readable
        $song_category->created_at = Carbon::parse($song_category->created_at)->diffForHumans();
        // edit updated_at for human readable
        $song_category->updated_at = Carbon::parse($song_category->updated_at)->diffForHumans();
        return response()->json( $song_category );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $song_category = SongCategory::with('parent', 'children', 'user')->findOrFail($id);
        return response()->json( $song_category );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SongCategoryRequest $request, string $id)
    {
        //
        // check request is valid
        if ($request->validated()) {
            // store data
            $song_category = SongCategory::findOrFail($id);
            $song_category->name = $request->name;
            $song_category->slug = Str::slug($request->name);
            $song_category->status = $request->status;
            $song_category->description = $request->desc;
            $song_category->parent_id = $request->parent_id ? $request->parent_id : 0;
            $song_category->order = $request->order;
            $song_category->is_featured = $request->is_featured;
            $song_category->is_special = $request->is_special;
            $song_category->save();
            // check if song_category updated
            if ($song_category) {
                // send notification
                return response()->json(['success' => 'Song Category updated successfully.']);
            } else {
                // send notification
                return response()->json(['error' => 'Song Category could not be updated.']);
            }
        } else {
            // send notification
            return response()->json(['error' => 'Song Category could not be updated.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // soft delete
        $song_category = SongCategory::findOrFail($id);
        $song_category->delete();

        // check if song_category deleted
        if ($song_category) {
            // send notification
            return response()->json(['success' => 'Song Category deleted successfully.']);
        } else {
            // send notification
            return response()->json(['error' => 'Song Category could not be deleted.']);
        }
    }
}
