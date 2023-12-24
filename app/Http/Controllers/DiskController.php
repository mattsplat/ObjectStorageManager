<?php

namespace App\Http\Controllers;

use App\Models\Disk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;

class DiskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Disk $disk, Request $request)
    {
        return view('disk', compact('disk'));
    }

}
