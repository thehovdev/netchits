<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageUpload
{
    private $uploadedFile;

    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }
    
    public function getFileName()
    {
        return pathinfo($this->uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
    }

    public function getFileExtension()
    {
        return $this->uploadedFile->getClientOriginalExtension();
    }

    public function upload(string $path, string $fileName)
    {
        $this->uploadedFile->move($path, $fileName);
    }

}
