@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    All comics of Category: {{ $category->name }}
                </h1>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th colspan="3" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->comics()->get() as $comic)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $comic->title }}</td>
                            <td>{{ $comic->created_at }}</td>
                            <td>{{ $comic->updated_at }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.comics.show', $comic->slug) }}">View</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
@endsection
