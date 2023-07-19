<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Song;
use App\Models\Frontend\SongCheckout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class SongCheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request )
    {
        //
        $this->validate($request, [
            'user_id' => 'required',
            'song_id' => 'required',
        ]);

        $user_id = $request->user_id;
        $song_id = $request->song_id;

        $song = Song::find($song_id);
        $user = User::find($user_id);

        // check if user has enough connects and song id, user id already exists
        if( $user->connects < 1 ) {
            return response()->json([
                'success' => false,
                'icon' => 'error',
                'message' => 'You do not have enough connects to checkout this song',
                'data' => []
            ], 200);
        }

        $isPurchased = $user && $user->songCheckouts()->where('song_id', $song->id)->exists();

        if( $isPurchased ) {
            return response()->json([
                'success' => false,
                'icon' => 'error',
                'message' => 'You have already purchased this song',
                'data' => []
            ], 200);
        }

        $song_checkout = new SongCheckout();
        $song_checkout->invoice_no = uniqid();
        $song_checkout->song_id = $song_id;
        $song_checkout->user_id = $user_id;
        $song_checkout->connects = 1;
        $song_checkout->save();

        $user->connects = $user->connects - 1;

        $user->save();

        return response()->json([
            'success' => 'Success!',
            'icon' => 'success',
            'message' => 'Song Checkout Successfully',
            'data' => $song_checkout
        ], 200);


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
