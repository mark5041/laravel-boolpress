<?php

namespace App\Http\Controllers\Admin;

use App\Comic;
use App\User;
use App\Category;
use App\Writer;
use App\Artist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComicController extends Controller
{


    public $validator = [
        'title' => 'required',
        'description' => 'nullable|max:255',
        'thumb' => 'required',
        'price' => 'required|max:100',
        'sale_date' => 'nullable',
        'quantity' => 'required|integer'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comic::paginate(8);
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

        if (!empty($data['thumb'])) {
            $img_path = Storage::put('uploads', $data['thumb']);
            $data['thumb'] = $img_path;
        }


        $comic = new Comic();
        $comic->fill($data);
        $comic->slug = $comic->createSlug($data['title']);
        $comic->save();

        if (!empty($data['artists'])) {
            $artists = explode(", ", $data['artists']);
            $artist_id = [];
            foreach($artists as $element)
            {
                $artist = rtrim($element, ".");
                $checkArtist = Artist::where('name', $artist)->first();
                if(empty($checkArtist))
                {
                    $newArtist = new Artist();
                    $newArtist->name = $artist;
                    $newArtist->save();
                }
                $item_id = Artist::where('name', $artist)->first();
                array_push($artist_id, $item_id->id);
            }

            

            $comic->artist()->sync($artist_id);
        } 
        else 
        {
            //if we don't have tags we detach all
            $comic->artist()->detach();
        }


        if (!empty($data['writers'])) {
            $writers = explode(", ", $data['writers']);
            $writer_id = [];
            foreach($writers as $element)
            {
                $writer = rtrim($element, ".");
                $checkWriter = Writer::where('name', $writer)->first();
                if(empty($checkWriter))
                {
                    $newwriter = new writer();
                    $newwriter->name = $writer;
                    $newwriter->save();
                }
                $item_id = Writer::where('name', $writer)->first();
                array_push($writer_id, $item_id->id);
            }
        
            
        
            $comic->writer()->sync($writer_id);
        } 
        else 
        {
            //if we don't have tags we detach all
            $comic->writer()->detach();
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
        if (Auth::user()->id != $comic->user_id) {
            abort('403');
        }
        $categories = Category::all();
        $artists = Artist::all();

        return view('admin.comics.edit', ['comic' => $comic, 'categories' => $categories, 'artists' => $artists]);
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

        $request->validate(
            [
                'title' => 'required',
                'description' => 'required|max:255',
                'thumb' => 'required',
                'price' => 'required|max:100',
                'artists' => 'required',
                'writers' => 'required',
                'sale_date' => 'nullable',
                'quantity' => 'required|integer'
            ]
        );

        if (!empty($data['thumb'])) {
            Storage::delete($comic->thumb);

            $img_path = Storage::put('uploads', $data['thumb']);
            $comic->thumb = $img_path;
        }

        if ($data['title'] != $comic->title) {
            $comic->title = $data['title'];
            $comic->slug = $comic->createSlug($data['title']);
        }

        if ($data['category_id'] != $comic->category_id) {
            $comic->category_id = $data['category_id'];
        }

        $comic->update();

        if (!empty($data['artists'])) {
            $artists = explode(", ", $data['artists']);
            $artist_id = [];
            foreach($artists as $element)
            {
                $artist = rtrim($element, ".");
                $checkArtist = Artist::where('name', $artist)->first();
                if(empty($checkArtist))
                {
                    $newArtist = new Artist();
                    $newArtist->name = $artist;
                    $newArtist->save();
                }
                $item_id = Artist::where('name', $artist)->first();
                array_push($artist_id, $item_id->id);
            }

            

            $comic->artist()->sync($artist_id);
        } 
        else 
        {
            //if we don't have tags we detach all
            $comic->artist()->detach();
        }


        if (!empty($data['writers'])) {
            $writers = explode(", ", $data['writers']);
            $writer_id = [];
            foreach($writers as $element)
            {
                $writer = rtrim($element, ".");
                $checkWriter = Writer::where('name', $writer)->first();
                if(empty($checkWriter))
                {
                    $newwriter = new writer();
                    $newwriter->name = $writer;
                    $newwriter->save();
                }
                $item_id = Writer::where('name', $writer)->first();
                array_push($writer_id, $item_id->id);
            }
        
            
        
            $comic->writer()->sync($writer_id);
        } 
        else 
        {
            //if we don't have tags we detach all
            $comic->writer()->detach();
        }


        return redirect()->route('admin.comics.show', ['comic' => $comic]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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

