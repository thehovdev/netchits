<?php

final class ImageUploader
{
    private $storage;
    private $thumbCreator;

    public function __construct(Storage $storage, ThumbCreator $thumbCreator)
    {
        $this->storage = $storage;
        $this->thumbCreator = $thumbCreator;
    }
    public function upload(string $fileName, UploadFile $file): void
    {
        $avatar = $fileName;

        Storage::put($fileName, $file);
    }
}
