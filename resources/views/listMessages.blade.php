<?php use Carbon\Carbon;?>
@extends('layouts.main-layout')

@section('content')
<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <section class="content py-4">

<!-- Default box -->
<div class="card p-2">
    <div class="card-header">
        <h5 class="card-title">Contact Message</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped projects" id="proj">
            <thead>
                <tr>
                    <th class="project-state">Date</th>
                    <th class="project-state">Time</th>
                    <th class="project-state"> First Name</th>
                    <th class="project-state">Last Name</th>
                    <th class="project-state">Mobile</th>
                    <th class="project-state">Email</th>
                    <th class="project-state">User Message</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr id="id{{ $contact->id }}">
                    <td class="project-state">{{substr($contact->created_at,0,10)}}</td>
                    <td class="project-state">{{substr($contact->created_at,10)}}</td>
                    <td class="project-state">{{ $contact->fname }} </td>
                    <td class="project-state">{{ $contact->lname }} </td>
                    <td class="project-state">{{ $contact->mobile }} </td>
                    <td class="project-state">{{ $contact->email }} </td>
                    <td class="project-state">{{ $contact->msg }} </td>
                    <td>
                        <a href="{{url('listMessages',$contact->id)}}" class="btn btn-danger btn-sm my-1"><i class="fa-solid fa-trash"></i></a>
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

@endsection
