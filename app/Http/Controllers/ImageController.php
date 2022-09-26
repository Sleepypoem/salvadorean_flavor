<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Http\Traits\HasAuthorization;
use App\Models\User;

class ImageController extends Controller
{
    use HasAuthorization;

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