<?php

namespace App\Http\Controllers\Backend;

use App\Models\UpdateVersion;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestUpdate = UpdateVersion::latest()->first();
        return view('backend.index', compact('latestUpdate'));
    }
}
