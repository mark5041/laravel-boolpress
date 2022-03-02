<?php

namespace App\Http\Controllers\Admin;

use App\Comic;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComicController extends Controller
{


    public $validator = [
        'title' => 'required',
        'description' => 'nullable|max:255',
        'thumb' => 'required',
        'price' => 'required|max:100',
        'sale_date' => 'nullable|date|after:tomorrow',
        'type' => 'required',
        'artists' => 'required',
        'writers' => 'required',
        'quantity' => 'required|integer'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comic::paginate(5);
        return view('admin.comics.index', compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $request->validate($this->validator);

        $data = $request->all();
        $comic = new Comic();
        $comic->fill($data);
        $comic->slug = $comic->createSlug($data['title']);

        $save = $comic->save();

        if (!$save) {
            dd('salvataggio non riuscito');
        }

        return redirect()->route('admin.comics.show', $comic->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comic)
    {
        return view('admin.comics.show', ['comic' => $comic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {
        return view('admin.comics.edit', ['comic' => $comic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
?>

