<?php

namespace App\Http\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

/**
 * Image manager trait.
 */
trait ImageManager
{
    private $allowed_formats = [".png", ".jpg", ".jpeg", ".gif", ".jfif", ".pjpeg", ".pjp"];

    /**
     * Decodes a base_64 image and saves it's content to public folder.
     *
     * @param [type] $route The folder where the image should be saved.
     * @param [type] $encoded_image The base_64 encoded image.
     * @return string Returns the file name id success, else eill return the default image name: "default.png".
     */
    public function saveImage($route, $encoded_image)
    {
        if ($encoded_image === null) {
            return "default.png";
        }
        $image_64 = $encoded_image; //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        // find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = uniqid("img_") . '.' . $extension;

        $fileName = "images/" . $route . $imageName;

        if (!Storage::disk('public')->put($fileName, base64_decode($image))) {
            return "default.png";
        };

        return $imageName;
    }

    /**
     * Deletes a saved image from the public folder.
     *
     * @param Image|null $obj_image The image model that contains the info of the image being deleted.
     * @param string $route The folder where the image resides.
     * @return void
     */
    public function deleteImage(Image|null $obj_image, string $route)
    {
        if ($obj_image === null) {
            return;
        }

        if (Storage::disk("public")->exists("images/$route/" . $obj_image->image) && $obj_image->image != "default.png") {
            Storage::disk("public")->delete("images/$route/" . $obj_image->image);
            $obj_image->delete();
        }
    }
}