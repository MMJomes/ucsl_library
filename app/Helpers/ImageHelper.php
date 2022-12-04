<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

trait ImageHelper
{

    public function uploadImage($image, $directory, $nullable = false)
    {
        if ($image) {
            $upload_path = public_path() . "/upload/{$directory}/";
            if (!file_exists($upload_path)) {
                File::makeDirectory($upload_path, $mode = 0777, true, true);
            }
            $file_ext = $image->getClientOriginalExtension();
            $filename = time() . round(microtime(true) * 1000) . '.' . $file_ext;
            $image->move($upload_path, $filename);
            $image_url = "/upload/{$directory}/" . $filename;
            return $image_url;
        }
        return $nullable ? null : "/assets/images/user.png";
    }

    public function upload($file, $directory, $nullable = false)
    {
        if ($file) {
            $upload_path = public_path() . "/upload/{$directory}/";
            $file_ext = $file->getClientOriginalExtension();
            $filename = time() .  round(microtime(true) * 1000) . '.' . $file_ext;
            $file->move($upload_path, $filename);
            $file_url = "/upload/{$directory}/" . $filename;
            return $file_url;
        }
        return null;
    }


    public function deleteImage($path)
    {
        if ($path && $path != "/assets/images/user.png") {
            try {
                unlink(public_path() . $path);
            } catch (\Throwable $th) {
            }
        }
    }
}
