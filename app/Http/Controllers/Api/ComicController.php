<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comic;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::paginate(10);

        return response()->json([
            'response' => true,
            'results' =>  $comics,
        ]);
    }
}


