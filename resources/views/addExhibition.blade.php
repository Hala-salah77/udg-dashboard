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
                <h3 class="card-title">Create New Exhibition</h3>
            </div>
            <form action="{{url('/addExhibition/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="enTitle" class="form-label">English Title</label>
                        <input type="text" class="form-control @error('enTitle') is-invalid @enderror" id="enTitle" name="enTitle" value="{{ old('enTitle') }}" placeholder="Enter Title in English" dir="auto">
                        @error('enTitle')
                        <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="arTitle" class="form-label">Arabic Title</label>
                        <input type="text" class="form-control @error('arTitle') is-invalid @enderror" id="arTitle" name="arTitle" value="{{ old('arTitle') }}" placeholder="Enter Title in Arabic" dir="auto">
                        @error('arTitle')
                        <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="Enter Exhibition Link" dir="auto">
                        @error('link')
                        <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="images">Upload Images</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple required>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <input type="checkbox" name="activationLink" style="margin:10px;">
                            <label>Do you want to Active Link for This Exhibition</label>
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
