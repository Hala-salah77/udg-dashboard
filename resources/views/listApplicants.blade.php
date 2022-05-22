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
                <h5 class="card-title">All Applicants Information</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects" id="proj">
                    <thead>
                        <tr>
                            <th class="project-state">Date</th>
                            <th class="project-state">Time</th>
                            <th class="project-state">Name</th>
                            <th class="project-state">Email</th>
                            <th class="project-state">Mobile</th>
                            <th class="project-state">Graduation Year</th>
                            <th class="project-state">Current Salary</th>
                            <th class="project-state">Expected Salary</th>
                            <th class="project-state">BirthDate</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apps as $app)
                        <tr id="id{{ $app->id }}">
                            <td class="project-state">{{substr($app->created_at,0,10)}}</td>
                            <td class="project-state">{{substr($app->created_at,10)}}</td>
                            <td class="project-state">{{ $app->name }} </td>
                            <td class="project-state">{{ $app->email }} </td>
                            <td class="project-state">{{ $app->mobile }} </td>
                            <td class="project-state">{{ $app->graduationYear }} </td>
                            <td class="project-state">{{ $app->currentSalary }}</td>
                            <td class="project-state">{{ $app->expectedSalary }}</td>
                            <td class="project-state">{{ $app->birthDate }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm my-1" href="{{$app->cv}}"><i class="fas fa-download"></i></a>
                                <a href="{{url('listApplicants',$app->id)}}" class="btn btn-danger btn-sm my-1"><i class="fa-solid fa-trash"></i></a>
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
