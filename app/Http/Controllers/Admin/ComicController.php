<?php

namespace App\Http\Controllers\Admin;

use App\Comic;
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
        $data = [
            'comics' => $comics,
            'title' => 'Comics Home'
        ];

        return view('admin.comics.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comics.create', ['title' => 'Create New Comic']);
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
        $comic->save();

        $save = $comic->save();

        if (!$save) {
            dd('Salvataggio non riuscito');
        }


        return redirect()->route('admin.comics.show', $comic->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comic)
    {
        $data = [
            'comic' => $comic,
            'title' => $comic->name
        ];
        return view('admin.comics.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comic  $comic
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
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        $data = $request->all();
        $updated = $comic->update($data);

        if (!$updated) {
            dd('update non riuscito');
        }

        return redirect()->route('admin.comics.show', $comic->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        $comic->delete();

        return redirect()
            ->route('admin.comics.index')
            ->with('status', "Comic $comic->title deleted!");
    }
}
?>

