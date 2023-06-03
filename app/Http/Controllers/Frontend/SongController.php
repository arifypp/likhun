<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Backend\Song;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SongController extends Controller
{
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
        $this->module_path = 'all-song';

        // module icon
        $this->module_icon = 'songs';

        // module model name, path
        // $this->module_model = "Modules\Tag\Entities\Tag";
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return "Welcome to Song Page";
        $song = Song::orderBy('id', 'desc')->paginate(10);

        return view('frontend.pages'. '.' . $this->module_path, compact('song'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
