@extends('layouts.main-layout')

@section('content')
<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
<!-- Start List All Exhibitions -->
    <section class="content py-4">
        <!-- Default box -->
        <div class="card p-2 mb-0">
            <div class="card-header">
                <h5 class="card-title">All Exhibitions</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects" id="proj">
                    <thead>
                        <tr>
                            <th class="project-state">ID</th>
                            <th class="project-state"> AR Title</th>
                            <th class="project-state"> EN Title</th>
                            <th class="project-state"> Images</th>
                            <th class="project-state">Created at</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exhibition as $ex)
                        <tr id="id{{ $ex->id }}">
                            <td class="project-state">{{ $ex->id }}</td>
                            <td class="project-state">{{ $ex->arTitle }}</td>
                            <td class="project-state">{{ $ex->enTitle }}</td>
                            @if (count($ex->images)>0)
                            <td class="project-state">
                                @foreach ($ex->images as $img)
                                    <a href="{{$img->image}}" target="_blank"><img src="{{ asset($img->image) }}" style="max-width:150px;max-height:100px"/></a>
                                @endforeach
                            </td>
                            @endif

                            <td class="project-state">{{substr($ex->created_at,0,10)}}</td>
                            <td>
                                <i class="btn btn-dark btn-sm my-1 fas fa-square-check status{{ $ex->activationLink }} fw-bold"></i>
                                <a href="{{url('exhibitions',$ex->id)}}" class="btn btn-danger btn-sm my-1"><i class="fa-solid fa-trash"></i></a>
                                <button id="editBtn" type="button" class="btn btn-warning btn-sm my-1" data-bs-toggle="modal" data-bs-target="#editModal" title="{{$ex}}"><i class="fa-solid fa-pen-to-square" title="{{$ex}}"></i></button>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
</div>
<!-- Start Edit Modal-->
<!-- Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Exhibition</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{url('updateExhibition',$ex->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input id="idEdit" hidden >
                        <div class="form-group">
                            <label for="enTitle" class="form-label">English Title</label>
                            <input id="enTitleEdit" type="text" class="form-control @error('enTitle') is-invalid @enderror" id="enTitle" name="enTitle"  placeholder="Enter EN Title" required dir="auto">
                            @error('enTitle')
                            <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="arTitle" class="form-label">Arabic Title</label>
                            <input id="arTitleEdit" type="text" class="form-control @error('arTitle') is-invalid @enderror" id="arTitle" name="arTitle"  placeholder="Enter AR Title" required dir="auto">
                            @error('arTitle')
                            <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link" class="form-label">Link</label>
                            <input id="enLinkEdit" type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="Enter Event Link" dir="auto">
                            @error('link')
                            <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="image">Upload Images</label>
                                <input id="imgEdit" type="file" class="form-control" id="image" name="images[]" multiple>
                        </div>
                        <div class="form-group mb-0">
                            <div>
                                <input type="checkbox" name="activationLink" style="margin:10px;">
                                <label>Do you want to Active Link for This Exhibition</label>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-warning">Edit Exhibition<button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
        let Exhibitions=[];
        document.addEventListener("click", function(e){
            /* console.log(e.target.title); */
            Exhibitions=JSON.parse(e.target.title);
            document.getElementById("idEdit").value=Exhibitions.id;
            document.getElementById("arTitleEdit").value=Exhibitions.arTitle;
            document.getElementById("enTitleEdit").value=Exhibitions.enTitle;
            document.getElementById("enLinkEdit").value=Exhibitions.link;
            console.log(Exhibitions)
        });



    </script>
@endsection
