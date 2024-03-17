<?php

namespace App\Services;

use App\Interfaces\FileInterface;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class FileService implements FileInterface
{
    public function uploadProfilePic($file)
    {
        $directory = 'upload/profile-pic';
        $directoryPath = public_path($directory);

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        $fileName = $directory . '/' . Str::random(5) . time() . random_int(111, 999) . '.' . $file->getClientOriginalExtension();

        $manager = new ImageManager(Driver::class);
        $image = $manager->read($file);
        $image->save(public_path($fileName));
        return $fileName;
    }

    public function profilePicAvatar($file)
    {
        $directory = 'upload/avatar';
        $directoryPath = public_path($directory);

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        $fileName = $directory . '/' . Str::random(5) . time() . random_int(111, 999) . '.' . $file->getClientOriginalExtension();

        $manager = new ImageManager(Driver::class);
        $image = $manager->read($file);

        $originalWidth = $image->width();
        $originalHeight = $image->height();

        $width = 50;
        $height = null;

        if ($originalWidth < $originalHeight){
            $width = null;
            $height = 50;
        }

        $image->scale($width, $height)->save(public_path($fileName));
        return $fileName;
    }

    public function removeFile($fileUrl)
    {
        if (!blank($fileUrl) && file_exists($fileUrl)){
            @unlink($fileUrl);
        }
    }
}
