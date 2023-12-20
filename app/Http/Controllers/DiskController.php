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
//        $storage = $disk->storage;
//
//        $path = $request->path ?? '';
//
//        return $storage->listContents($path, false)
//            ->map(function (StorageAttributes $attributes) use ($storage) {
//                $data = $attributes->jsonSerialize();
//                if ($attributes->isFile()) {
//                    $data['url'] = $storage->url($attributes->path());
//                }
//
//                return $data;
//            })
//            ->toArray();


        return view('disk', compact('disk'));
    }

}
