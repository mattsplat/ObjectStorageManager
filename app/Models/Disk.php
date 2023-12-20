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
}
