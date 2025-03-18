<?php

namespace App\Services;

use App\Interfaces\FileUploadServiceInterface;
use Illuminate\Support\Facades\Storage;

class LocalFileUploadService implements FileUploadServiceInterface
{
    public function upload($file, $directory)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs($directory, $fileName, 'public');
        return $filePath;
    }

    public function delete($filePath)
    {
        if (!is_null($filePath)) {
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                return true;
            }
        }
        return false;
    }
}
