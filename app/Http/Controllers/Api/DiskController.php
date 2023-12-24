<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return Disk::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $disk = (new \App\Models\Disk())->fill([
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

        // test connection
        try {
            $disk->storage->directories();
        } catch (\Exception $e) {
            return response()->json("Connection failed " . $e->getMessage(), 400);
        }
        $disk->save();

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

            if ($attributes->isFile()) {
                // it takes a long time to get the visibility of each file so we don't do it and if the url fails we assume it's private
                $data['url'] = $storage->url($attributes->path());
            }

            return $data;
        })
            ->filter(fn($item) => !str_ends_with($item['path'], '.DS_Store'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disk $disk)
    {
        $disk->fill(
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

        // test connection
        try {
            $disk->storage->directories('');
        } catch (\Exception $e) {
            return response()->json("Connection failed " . $e->getMessage(), 400);
        }
        $disk->save();

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
