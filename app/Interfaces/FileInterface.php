<?php

namespace App\Interfaces;

interface FileInterface
{
    public function uploadProfilePic($file);
    function profilePicAvatar($file);
    public function removeFile($fileUrl);
}
