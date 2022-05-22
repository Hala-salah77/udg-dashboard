@extends('layouts.main-layout')

@section('content')
<div class="container-fluid p-0">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center bg-white">
        <img src="https://cdn.dribbble.com/users/888330/screenshots/2653750/media/b7459526aeb0786638a2cf16951955b1.png" style="height:98vh;" alt="there is no data to show">
    </div>
</div>
@endsection
