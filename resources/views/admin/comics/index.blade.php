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
                            <th>Title</th>
                            <th>Writers</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Date Release</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($comics as $comic)
                        <tr>
                            <td>{{ $comic->title }}</td>
                            <td>{{ $comic->writers }}</td>
                            <td>{{ $comic->artists }}</td>
                            <td>{{ $comic->price }} €</td>
                            <td>{{ $comic->sale_date }}</td>
                            <td class="d-flex justify-content-space-around">
                                <a class="btn btn-secondary" href="{{ route('admin.comics.show', $comic) }}">View</a>
                                @if (Auth::user()->id === $comic->user_id)
                                    <a class="btn btn-info" href="{{ route('admin.comics.edit', $comic->slug) }}">Modify</a>
                                @endif
                                <form action="{{ route('admin.comics.destroy', $comic->id) }}" method="post">
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