<?php

namespace App\Http\Controllers\Admin;

use App\Comic;
use App\User;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComicController extends Controller
{


    public $validator = [
        'title' => 'required',
        'description' => 'nullable|max:255',
        'thumb' => 'required',
        'price' => 'required|max:100',
        'sale_date' => 'nullable|date|after:tomorrow',
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
        return view('admin.comics.index', ['comics' => $comics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.comics.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $validator = $request->validate(
            [
                'title' => 'required|max:240',
                'thumb' => 'required',
                'category_id' => 'exists:App\Category,id'
            ]
        );


        $comic = new Comic();
        $comic->fill($data);
        $comic->slug = $comic->createSlug($data['title']);
        $comic->save();

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
        if (Auth::user()->id != $comic->user_id) {
            abort('403');
        }
        $categories = Category::all();

        return view('admin.comics.edit', ['comic' => $comic, 'categories' => $categories]);
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
        $data = $request->all();
        if (Auth::user()->id != $comic->user_id) {
            abort('403');
        }


        $validator = $request->validate(
            [
                'title' => 'required|max:240',
                'thumb' => 'required',
                'category_id' => 'exists:App\Category,id'
            ]
        );

        if ($data['title'] != $comic->title) {
            $comic->title = $data['title'];
            $comic->slug = $comic->createSlug($data['title']);
        }
        if ($data['thumb'] != $comic->content) {
            $comic->content = $data['thumb'];
        }
        if ($data['category_id'] != $comic->category_id) {
            $comic->category_id = $data['category_id'];
        }

        $comic->update();

        return redirect()->route('admin.comics.show', $comic);
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

