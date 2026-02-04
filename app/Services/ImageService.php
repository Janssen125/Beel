<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public function uploadImage(UploadedFile $file, $folder = 'images')
    {
        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs($folder, $filename, 'public');

        return Storage::url($path);
    }

    public function deleteImage($imagePath)
    {
        $relativePath = str_replace('/storage/', '', $imagePath);
        Storage::disk('public')->delete($relativePath);
    }
}
