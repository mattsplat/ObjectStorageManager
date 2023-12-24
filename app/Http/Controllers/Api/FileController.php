<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Disk;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // todo save file
    }

    /**
     * Display the specified resource.
     */
    public function show(Disk $disk, Request $request)
    {

        $path = $request->path ?? '';
        $file = $disk->getFileMetadata($path);

        return $file;
    }


    public function download(Disk $disk, Request $request)
    {
        $path = $request->path;
        $fileParts = explode('/', $path);
        $fileName = end($fileParts);
        if (!$path) {
            return response()->error('Path is required');
        }

        $file = $disk->storage->get($path);
        $client = new \Native\Laravel\Client\Client();
        $downloadsPath = $client->get('app/path/downloads')->json('path');
        if(empty($downloadsPath)) {
            return response()->error('Downloads path not found');
        }
        $fullPath = $downloadsPath . '/' . $fileName;
        file_put_contents($fullPath, $file);

        return response()->json([
            'path' => $fullPath,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // todo update visibility
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disk $disk, Request $request)
    {
        $path = $request->path;
        if (!$path || !$disk->storage->exists($path)) {
            return response()->error('Path is required');
        }

        $disk->storage->delete($path);

        return response()->json([
            'message' => 'File deleted successfully',
        ]);
    }

}
