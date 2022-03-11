<?php

namespace App\Http\Controllers\Api;

use App\Artist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Comic;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::orderByDesc('quantity')->paginate(9);

        return response()->json([
            'response' => true,
            'count' => $comics->count(),
            'results' =>  [
                'data' => $comics
            ],
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $comics = Comic::where('id', '>', 0);

        if (array_key_exists('searchedElement', $data))
        {
            $comics = $comics->where('title', 'like', '%'.$data['searchedElement'].'%');
        }

        $comics = $comics->paginate(9);

        return response()->json([
            'response' => true,
            'count' =>  $comics->count(),
            'results' =>  [
                'data' => $comics
            ],
        ]);
    }

    public function show($id)
    {
        $comic = Comic::find($id);
        $comic['artists'] = $comic->artist()->get();
        $comic['writers'] = $comic->writer()->get();


        return response()->json([
            'response' => true,
            'count' => $comic ? 1 : 0,
            'results' =>  [
                'data' => $comic,
            ],
        ]);
    }
}


