<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Disk;
use Illuminate\Http\Request;
use League\Flysystem\StorageAttributes;

class DiskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Disk::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $disk = \App\Models\Disk::create([
            'name' => $request->name,
            'key' => $request->key,
            'secret' => $request->secret,
            'region' => $request->region,
            'bucket' => $request->bucket,
            'folder' => $request->folder,
            'url' => $request->url,
            'endpoint' => $request->endpoint,
            'use_path_style_endpoint' => $request->use_path_style_endpoint ?? false,
        ]);

        return $disk;
    }

    /**
     * Display the specified resource.
     */
    public function show(Disk $disk, Request $request)
    {
        $storage = $disk->storage;

        $path = $request->path ?? '';

        $results = collect($storage->listContents($path, false)->toArray());

        return $results->map(function (StorageAttributes $attributes) use ($storage) {
            $data = $attributes->jsonSerialize();
            if ($attributes->isFile() && $storage->getVisibility($attributes->path()) === 'public') {
                $data['url'] = $storage->url($attributes->path());
            }

            return $data;
        });
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disk $disk)
    {
        $disk->update(
            $request->only([
                'name',
                'key',
                'secret',
                'region',
                'bucket',
                'folder',
                'url',
                'endpoint',
                'use_path_style_endpoint',
            ])
        );

        return $disk;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disk $disk)
    {
        $disk->delete();

        return response()->json(null, 204);
    }
}
