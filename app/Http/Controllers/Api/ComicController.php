<?php

namespace App\Http\Controllers\Api;

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
            'count' => count($comics),
            'results' =>  [
                'data' => $comics
            ],
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->all();
        if($data['searchedElement'] == '')
        {
            $comics = null;
        }
        else
        {
            $comics = Comic::where('title', 'like', '%'.$data['searchedElement'].'%')->paginate(9);
        }

        // if (array_key_exists('searchedElement', $data))
        // {
            
        // }
        // if (
        //     array_key_exists('orderbycolumn', $data) &&
        //     array_key_exists('orderbysort', $data)
        // ) {
        //     $comics->orderBy($data['orderbycolumn'], $data['orderbysort']);
        // }

        // if (array_key_exists('tags', $data)) {
        //     foreach ($data['tags'] as $tag) {
        //         //fa una join per controllare i tag che sono associati al comic
        //         $comics->whereHas('tags', function (Builder $query) use ($tag) {
        //             $query->where('name', '=', $tag);
        //         });
        //     }
        // }

        // $comics = $comics->with(['tags', 'category'])->get();

        return response()->json([
            'response' => true,
            'count' => count($comics),
            'results' =>  $comics
        ]);
    }
}


