@extends('layouts.main-layout')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div>
        <div class="row justify-content-center align-items-center my-5">
        <div class="card h-100 mb-0 card-primary p-0 w-75">
            <div class="card-header">
                <h3 class="card-title">Create New Event</h3>
            </div>
            <form action="{{url('/addEvents/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="Enter Event Link" dir="auto">
                        @error('link')
                        <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="image">Upload Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                                <div class="text-danger mt-5 py-1">*{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <input type="checkbox" name="activationLink" style="margin:10px;">
                            <label>Do you want to Active Link for This Event</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add Event">
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection
