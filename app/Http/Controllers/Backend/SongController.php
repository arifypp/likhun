<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use Illuminate\Support\Str;
use App\Models\Backend\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Requests\SongRequest;
use App\Http\Controllers\Controller;
use App\Models\Backend\SongCategory;

class SongController extends Controller
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
        $this->module_title = 'Song';

        // module name
        $this->module_name = 'songs';

        // directory path of the module
        $this->module_path = 'backend.songs';

        // module icon
        $this->module_icon = 'songs';

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
            $data = Song::latest()->with('category', 'artist')->get();
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

        return view($module_path.'.index', compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular'));       

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
    public function store(SongRequest $request)
    {
        //
        if( $request->validated() ) {
            $song = new Song();
            $song->title = $request->name;
            $song->slug = Str::slug($request->name);
            $song->lyrics = $request->lyrics;
            $song->short_description = $request->short_description;
            $song->status = $request->status;
            $song->song_category_id = $request->song_category_id;
            $song->song_artist_id = $request->song_artist_id;
            $song->meta_title = $request->meta_title;
            $song->meta_keywords = $request->meta_keywords;
            $song->meta_description = $request->meta_description;
            $song->save();
            return response()->json(['success'=>'Song saved successfully.']);
        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $song = Song::with('category', 'artist', 'user')->findOrFail($id);
        return response()->json($song);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $song = Song::with('category', 'artist')->findOrFail($id);
        return response()->json($song);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SongRequest $request, string $id)
    {
        //
        if( $request->validated() ) {
            $song = Song::findOrFail($id);
            $song->title = $request->name;
            $song->slug = Str::slug($request->name);
            $song->lyrics = $request->lyrics;
            $song->short_description = $request->short_description;
            $song->status = $request->status;
            $song->song_category_id = $request->song_category_id;
            $song->song_artist_id = $request->song_artist_id;
            $song->meta_title = $request->meta_title;
            $song->meta_keywords = $request->meta_keywords;
            $song->meta_description = $request->meta_description;
            $song->save();
            return response()->json(['success'=>'Song updated successfully.']);
        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $song = Song::findOrFail($id);
        $song->delete();
        return response()->json(['success'=>'Song deleted successfully.']);
    }
}
