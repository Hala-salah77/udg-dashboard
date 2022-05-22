@extends('layouts.main-layout')

@section('content')
<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
<!-- Start List All News -->
    <section class="content py-4">
        <!-- Default box -->
        <div class="card p-2 mb-0">
            <div class="card-header">
                <h5 class="card-title">All News</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects" id="proj">
                    <thead>
                        <tr>
                            <th class="project-state">English Title</th>
                            <th class="project-state">Arabic Title</th>
                            <th class="project-state"> Imgae</th>
                            <th class="project-state">English Description</th>
                            <th class="project-state">Arabic Description</th>
                            <th class="project-state">Link</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $new)
                        <tr id="id{{ $new->id }}">
                            <td class="project-state">{{ $new->enTitle }} </td>
                            <td class="project-state">{{ $new->arTitle }} </td>
                            <td class="project-state">
                                <img src="{{ asset($new->image) }}" style="max-width:150px;max-height=100px"/>
                            </td>
                            <td class="project-state"><?php
                                    if(strlen($new->enDesc) > 40 )
                                        echo substr($new->enDesc,0,40). ' ....';
                                    else
                                        echo $new->enDesc
                                ?>
                            </td>
                            <td class="project-state"><?php
                                if(strlen($new->arDesc) > 40 )
                                    echo substr($new->arDesc,0,40). ' ....';
                                else
                                    echo $new->arDesc
                                ?>
                            </td>
                            <td class="project-state"><?php
                                if(strlen($new->link) > 40 )
                                    echo substr($new->link,0,20). ' ....';
                                else
                                    echo $new->link
                                ?>
                            </td>
                            <td>
                                <i class="btn btn-dark btn-sm my-1 fas fa-square-check status{{ $new->activationLink }} fw-bold"></i>
                                <a href="{{url('news',$new->id)}}" class="btn btn-danger btn-sm my-1"><i class="fa-solid fa-trash"></i></a>
                                <!--<a href="{{url('editNews',$new->id)}}" class="btn btn-warning btn-sm my-1"><i class="fa-solid fa-trash"></i></a>-->
                                <!-- Button trigger modal -->
                                <button id="editBtn" type="button" class="btn btn-warning btn-sm my-1" data-bs-toggle="modal" data-bs-target="#editModal" title="{{$new}}"><i class="fa-solid fa-pen-to-square" title="{{$new}}"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit News</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
        <form action="{{url('updateNews',$new->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <input id="idEdit" hidden>
                    <div class="form-group">
                        <label for="enTitle" class="form-label">Englich Title</label>
                        <input id="enTitleEdit" type="text" class="form-control @error('enTitle') is-invalid @enderror" id="enTitle" name="enTitle" value="{{ old('enTitle') }}" placeholder="Enter Title in English" dir="auto">
                        @error('enTitle')
                        <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label id="arTitleEdit" for="arTitle" class="form-label">Arabic Title</label>
                        <input type="text" class="form-control @error('arTitle') is-invalid @enderror" id="arTitle" name="arTitle" value="{{ old('arTitle') }}" placeholder="Enter Title in Arabic" dir="auto">
                        @error('arTitle')
                        <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="enDesc" class="form-label">English Description</label>
                        <textarea id="enDescEdit" class="form-control @error('enDesc') is-invalid @enderror" id="enDesc" rows="3" name="enDesc" placeholder="English Description" dir="auto">{{ old('enDesc') }}</textarea>
                        @error('enDesc')
                            <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="arDesc" class="form-label">Arabic Description</label>
                        <textarea id="arDescEdit" class="form-control @error('arDesc') is-invalid @enderror" id="arDesc" rows="3" name="arDesc" placeholder="Arabic Description" dir="auto">{{ old('arDesc') }}</textarea>
                        @error('arDesc')
                            <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link" class="form-label">Link</label>
                        <input id="linkEdit" type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="Enter Event Link" dir="auto">
                        @error('link')
                        <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                    </div>
                <div class="form-group">
                    <label class="form-label" for="image">Upload Image</label>
                        <input id="imgEdit" type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                        @error('image')
                            <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group mb-0">
                    <div>
                        <input type="checkbox" name="activationLink" style="margin:10px;">
                        <label>Do you want to Active Link for This News</label>
                    </div>
                </div>
                </div>
                <div class="card-footer">
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-warning">Add News<button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
        let news=[];
        document.addEventListener("click", function(e){
            news=JSON.parse(e.target.title);
            document.getElementById("idEdit").value=news.id;
            document.getElementById("enTitleEdit").value=news.enTitle;
            document.getElementById("arTitleEdit").value=news.arTitle;
            document.getElementById("enDescEdit").value=news.enDesc;
            document.getElementById("arDescEdit").value=news.arDesc;
            document.getElementById("linkEdit").value=news.link;
            document.getElementById("imgEdit").value=news.image;
        });


    </script>
@endsection
