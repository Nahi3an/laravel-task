@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('error'))
                    <div class="card alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
    </div>
@endsection
