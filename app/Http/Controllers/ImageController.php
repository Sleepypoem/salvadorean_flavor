<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userImage($fileName)
    {
        $path = public_path() . "\\storage\\images\\users\\" . $fileName;
        return Response::download($path);
    }

    public function recipeImage($fileName)
    {
        $path = public_path() . "\\storage\\images\\recipes\\" . $fileName;
        return Response::download($path);
    }

    public function ingredientImage($fileName)
    {
        $path = public_path() . "\\storage\\images\\ingredients\\" . $fileName;
        return Response::download($path);
    }
}