<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function store(UploadedFile $file): string
    {
        return $file->store('files');
    }

    public function removeFile(string $path): bool
    {
        if (Storage::exists($path)) {
            return Storage::delete($path);
        }

        return false;
    }
}
