@extends('layouts.app')


@section('content')

<main class="comic">

    @if (session('status'))
        <div class="alert alert-success">
            <div class="container">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <h1 class="h1">Admin - All Comics</h1>
        </div>
        <div class="row">
            <div class="col mb-2">
                <a href="{{ route('admin.comics.create') }}" class="btn btn-primary">Add new comic</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Show categories</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-1">Title</th>
                            <th class="col-3">Writers</th>
                            <th class="col-3">Author</th>
                            <th class="col-1">Price</th>
                            <th class="col-1">Date Release</th>
                            <th class="col-3"> </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($comics as $comic)
                        <tr>
                            <td>{{ $comic->title }}</td>
                            <td>
                                @foreach ($comic->writer()->get() as $writer)
                                    {{ $writer->name }},
                                @endforeach
                            </td>
                            <td>
                                 @foreach ($comic->artist()->get() as $artist)
                                    {{ $artist->name }},
                                @endforeach
                            </td>
                            <td>{{ $comic->price }} €</td>
                            <td>{{ $comic->sale_date }}</td>
                            <td>
                                <a class="btn btn-secondary" href="{{ route('admin.comics.show', $comic) }}">View</a>
                                @if (Auth::user()->id === $comic->user_id)
                                    <a class="btn btn-info" href="{{ route('admin.comics.edit', $comic->slug) }}">Modify</a>
                                @endif
                                <form class="d-inline" action="{{ route('admin.comics.destroy', $comic) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                {{ $comics->links() }}
            </div>
        </div>
    </div>

</main>

@endsection