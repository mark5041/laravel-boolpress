@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="col-5" action="{{ route('admin.comics.update', $comic) }}" method="post" enctype="multipart/form-data">>
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <select class="form-select" name="category_id">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option @if (old('category_id', $comic->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }} - {{ $category->id }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value=" {{ old('title', $comic->title) }}">
                    @error('title')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">description</label>
                    <textarea class="form-control" id="description" rows="3"
                        name="description">{{ old('description', $comic->description) }}</textarea>
                    @error('description')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if (!empty($comic->thumb))
                <div class="mb-3">
                    <img class="w-50" src="{{ asset('storage/' . $comic->thumb) }}" alt="{{ $comic->title }}">
                </div>
                @endif
                <div class="mb-3">
                    <label for="thumb" class="form-label">Thumb</label>
                    <input class="form-control" type="file" id="thumb" name="thumb">
                    @error('thumb')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $comic->price) }}">
                    @error('price')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="sale_date" class="form-label">Sale Date</label>
                    <input type="date" class="form-control" id="sale_date" name="sale_date" value="{{ old('sale_date', $comic->sale_date) }}">
                    @error('price')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="artists" class="form-label">Artists</label>
                    <textarea class="form-control" id="artists" rows="3" name="artists"
                        >@php 
                            $artists = $comic->artist()->get();
                            $numArtists = count($artists);
                            $i = 0;
                            foreach($artists as $artist)
                            {
                                $i++;
                                if($numArtists === $i)
                                {
                                    echo "$artist->name.";
                                }
                                else
                                {
                                    echo "$artist->name, ";
                                }
                            }
                            
                        @endphp </textarea>
                    @error('artists')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="writers" class="form-label">Writers</label>
                    <textarea class="form-control" id="writers" rows="3" name="writers"
                        >@php 
                            $writers = $comic->writer()->get();
                            $numwriters = count($writers);
                            $i = 0;
                            foreach($writers as $writer)
                            {
                                $i++;
                                if($numwriters === $i)
                                {
                                    echo "$writer->name.";
                                }
                                else
                                {
                                    echo "$writer->name, ";
                                }
                            }
                            
                        @endphp </textarea>
                        @error('writers')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Writers</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $comic->quantity) }}">
                    @error('price')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection