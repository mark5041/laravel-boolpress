
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $comic->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <img class="img-fluid" src=" {{ $comic->thumb }}" alt="{{ $comic->title }}">
            </div>
            <div class="col-9">
                <div>{{ $comic->description }}</div>
                <div>
                    <h2>{{ $comic->price }} €</h2>
                </div>
            </div>
        </div>
    </div>
@endsection