
@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>
                        Welcome {{ Auth::user()->name }}
                    </h1>
                    
                    <a class="btn btn-primary" href="{{ route('admin.comics.index') }}">Go to Comics</a>
                </div>
            </div>
        </div>
    </div>
@endsection
