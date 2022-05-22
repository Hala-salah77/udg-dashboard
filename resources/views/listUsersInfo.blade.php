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
                <h5 class="card-title">Users Information</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects" id="proj">
                    <thead>
                        <tr>
                            <th class="project-state">ID</th>
                            <th class="project-state"> First Name</th>
                            <th class="project-state">Last Name</th>
                            <th class="project-state">Mobile</th>
                            <th class="project-state">Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usersInfo as $userInfo)
                        <tr id="id{{ $userInfo->id }}">
                            <td class="project-state">{{ $userInfo->id }}</td>
                            <td class="project-state">{{ $userInfo->fname }} </td>
                            <td class="project-state">{{ $userInfo->lname }} </td>
                            <td class="project-state">{{ $userInfo->mobile }} </td>
                            <td class="project-state">{{ $userInfo->email }} </td>
                            <td>
                                <a href="{{url('usersInfo',$userInfo->id)}}" class="btn btn-danger btn-sm my-1"><i class="fa-solid fa-trash"></i></a>
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
