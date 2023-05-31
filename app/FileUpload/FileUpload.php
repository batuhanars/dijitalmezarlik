<?php

namespace App\FileUpload;

class FileUpload
{

    public static $path;
    public static $file;

    public static function disk($path)
    {
        self::$path = $path;
        return new self;
    }

    public static function file($file)
    {
        self::$file = $file;
        return new self;
    }

    public function upload()
    {
        $fileName = uniqid() . "." . self::$file->extension();
        $fileNameWithUpload = self::$path . "/" . $fileName;
        self::$file->move(public_path(self::$path), $fileName);
        return $fileNameWithUpload;
    }
}
