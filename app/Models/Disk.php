<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Disk extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'key',
        'secret',
        'region',
        'bucket',
        'folder',
        'url',
        'endpoint',
        'use_path_style_endpoint',
    ];

    protected $casts = [
        'use_path_style_endpoint' => 'boolean',
    ];

    public function getStorageAttribute(): \Illuminate\Contracts\Filesystem\Filesystem
    {
        $data = ['driver' => 's3', ...$this->toArray()];
        $data['use_path_style_endpoint'] = (bool)$data['use_path_style_endpoint'];

        return Storage::build($data);
    }

    public function getFileMetadata($path)
    {
        $storage = $this->storage;

        $file = $storage->getClient()
            ->headObject([
                'Bucket' => $this->bucket,
                'Key' => $path,
            ])
            ->toArray();
        $file['visibility'] = $storage->getVisibility($path);
        if ($file['visibility'] === 'public') {
            $file['url'] = $storage->url($path);
        } else {
            $file['url'] = $storage->temporaryUrl(
                $path, now()->addMinutes(5)
            );
        }
        $file['mime_type'] = $file['ContentType'] ?? $storage->mimeType($path);

        return $file;
    }
}
