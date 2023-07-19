<?php

namespace App\Http\Controllers\Frontend;

use App\Events\LyricViewed;
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
    public function index(Request $request)
    {
        //
        // return "Welcome to Song Page";
        $songs = Song::where('status', 'published')->orderBy('id', 'desc')->paginate(12);
        return view('frontend.pages' . '.' . $this->module_path, compact('songs'))
        ->with('i', ($request->input('page', 1) - 1) * 12);
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
    public function show(string $slug)
    {
        //
        $song = Song::where('slug', $slug)->first(['id', 'title', 'slug', 'lyrics', 'song_artist_id', 'song_category_id', 'short_description', 'status', 'hits', 'created_at', 'updated_at']);

        // Check if the user has purchased the song
        $user = auth()->user();
        $isPurchased = $user && $user->songCheckouts()->where('song_id', $song->id)->exists();

        // If the user has not purchased the song, hide the lyrics
        if (!$isPurchased) {
            $song->lyrics = null;
        }

        event(new LyricViewed($song));

        // dd($song);

        return view('frontend.pages' . '.' . $this->module_path . '-details', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function search(Request $request)
    {
        //
        $lyricsSearch = $request->input('lyrics_search');

        // Retrieve the songs that match the search query
        $songs = Song::where('title', 'like', '%'.$lyricsSearch.'%')
                     ->orWhere('short_description', 'like', '%'.$lyricsSearch.'%')
                     ->paginate(12);
    
        return $songs;
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
