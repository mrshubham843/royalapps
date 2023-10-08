@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">
            <h5 class="card-title">First Name : {{ Auth::user()->firstName }}</h5>
            <h5 class="card-title">Last Name : {{ Auth::user()->lastName }}</h5>
            <h5 class="card-title">Email : {{ Auth::user()->email }}</h5>

        </div>

        <div style="display:inline-flex">
            <a type="button" class="btn btn-dark" href="{{ route('listAuthors') }}"
                style="    width: 20%;
    margin: auto;">Go Home</a>

            <a type="button" class="btn btn-dark" href="{{ route('logout') }}"
                style="    width: 20%;
    margin: auto;">Logout</a>
        </div>


    </div>
@endsection
