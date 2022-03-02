@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="col-5" action="{{ route('admin.comics.update', $comic->id) }}" method="post">
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
                        name="content"> {{ old('description', $comic->description) }}</textarea>
                    @error('description')
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