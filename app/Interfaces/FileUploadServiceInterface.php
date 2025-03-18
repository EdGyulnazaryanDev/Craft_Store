<?php

namespace App\Interfaces;

interface FileUploadServiceInterface
{
    public function upload($file, $directory);
    public function delete($filePath);
}
