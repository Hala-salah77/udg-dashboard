@extends('layouts.main-layout')

@section('content')
<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
<!-- Start List All Events -->
    <section class="content py-4">
        <!-- Default box -->
        <div class="card p-2 mb-0">
            <div class="card-header">
                <h5 class="card-title">All Events</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects" id="proj">
                    <thead>
                        <tr>
                            <th class="project-state">ID</th>
                            <th class="project-state"> Imgage</th>
                            <th class="project-state"> Link</th>
                            <th class="project-state">Created at</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr id="id{{ $event->id }}">
                            <td class="project-state">{{ $event->id }}</td>
                            <td class="project-state">
                                <a href="{{$event->image}}" target="_blank"><img src="{{ asset($event->image) }}" style="max-width:150px;max-height=100px"/></a>
                            </td>
                            <td class="project-state">{{$event->link}}</td>
                            <td class="project-state">{{substr($event->created_at,0,10)}}</td>
                            <td>
                                <i class="btn btn-dark btn-sm my-1 fas fa-square-check status{{ $event->activationLink }} fw-bold"></i>
                                <a href="{{url('events',$event->id)}}" class="btn btn-danger btn-sm my-1"><i class="fa-solid fa-trash"></i></a>
                                <button id="editBtn" type="button" class="btn btn-warning btn-sm my-1" data-bs-toggle="modal" data-bs-target="#editModal" title="{{$event}}"><i class="fa-solid fa-pen-to-square" title="{{$event}}"></i></button>
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{url('updateEvents',$event->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <input id="idEdit" hidden >
                    <div class="form-group">
                        <label for="link" class="form-label">Link</label>
                        <input id="linkEdit" type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="Enter Event Link" dir="auto">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="image">Upload Image</label>
                            <input id="imgEdit" type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                            @error('image')
                                <div class="text-danger mt-1 py-1">*{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group mb-0">
                            <input type="checkbox" name="activationLink">
                            <label>Do you want to Active Link for This Event</label>
                    </div>
                    <div class="card-footer">
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-warning">Edit Event<button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
        let events=[];
        document.addEventListener("click", function(e){
            events=JSON.parse(e.target.title);
            document.getElementById("idEdit").value=events.id;
            document.getElementById("linkEdit").value=events.image;
        });

    </script>
@endsection
