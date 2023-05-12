@extends('layouts.master')
@section('css')

    @section('title')
        Tasks
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Tasks</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Page Title</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        Add Tasks <i class="fa fa-plus"></i>
                    </button>

                    <br><br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>deadline</th>
                                <th>Status</th>
                                <th>Project Name</th>
                                <th>User</th>
                                <th>Process</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($tasks as $task)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$task->task_name }}</td>
                                    <td>{{$task->deadline}} </td>
                                    <td>
                                            @if ($task->status === 1)
                                                <p>ended</p>
                                            @else
                                               <p> Still Working </p>
                                            @endif

                                    </td>
                                    <td>{{$task->project->project_name }}</td>
                                     <td>{{$task->user->name}}</td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $task->id }}"
                                                title="edit_Client"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{$task->id}}"
                                                title="Soft delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <!-- edit model tasks -->
                                <div class="modal fade" id="edit{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    Edit  Task {{$task->task_name}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form class=" row mb-30" action="{{route('task.update','test')}}" method="POST">
                                                    {{method_field('patch')}}
                                                    @csrf

                                                    <div class="card-body">
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $task->id }}">

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="task_name"
                                                                       class="mr-sm-2">Task Name
                                                                </label>
                                                                <input id="name" type="text" name="task_name" required class="form-control" value="{{$task->task_name}}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="deadline"
                                                                       class="mr-sm-2">Deadline
                                                                </label>
                                                                <input type="date" id="deadline"  value="{{$task->deadline}}" class="form-control" name="deadline">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <label for="project_id"
                                                                   class="control-label">Assign Project</label>
                                                            <select name="project_id" class="custom-select" >
                                                                <!--placeholder-->
                                                                <option value="" selected
                                                                        disabled>Select Project
                                                                </option>
                                                                @isset($prjects)
                                                                    @foreach ($prjects as $prject)

                                                                        <option value="{{$prject->id}}" @if($task->project->id == $prject->id) selected @endif >{{ $prject->project_name}}</option>

                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div class="col">
                                                            <label for="inputName"
                                                                   class="control-label">Assign User</label>
                                                            <select name="user_id" class="custom-select" >
                                                                <!--placeholder-->
                                                                <option value="" selected
                                                                        disabled>Select User
                                                                </option>
                                                                @isset($users)
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}"> {{ $user->name }}
                                                                    </option>
                                                                        <option value="{{$user->id}}" @if($task->user->id == $user->id) selected @endif >{{ $user->name}}</option>

                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                        </div>

                                                        <br>
                                                        <div class="col">
                                                            <div class="form-check">

                                                                @if ($task->status === 0)
                                                                    <input
                                                                        type="checkbox"
                                                                        checked
                                                                        class="form-check-input"
                                                                        name="Status"
                                                                        id="exampleCheck1">
                                                                @else
                                                                    <input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        name="Status"
                                                                        id="exampleCheck1">
                                                                @endif
                                                                <label
                                                                    class="form-check-label"
                                                                    for="exampleCheck1">Statis</label>
                                                            </div>
                                                        </div>
                                                        <br><br>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>Close</button>
                                                            <button type="submit"
                                                                    class="btn btn-success">submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>

                                    </div>

                                </div>


                                <!-- delete model tasks -->
                                <div class="modal fade" id="delete{{ $task->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    Delete Task
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('task.destroy','test')}}" method="post">
                                                    {{method_field('Delete')}}
                                                    @csrf
                                                    .! Warning You are delete Task  {{ $task->task_name }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $task->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>Close</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add_modal Tasks -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            Add project
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{route('task.store')}}"method="POST">
                            @csrf
                            <div class="card-body">

                                            <div class="row">
                                                <div class="col">
                                                    <label for="task_name"
                                                           class="mr-sm-2">Task Name
                                                    </label>
                                                    <input id="name" type="text" name="task_name" required class="form-control" value="{{old('task_name')}}">
                                                </div>
                                                <div class="col">
                                                    <label for="deadline"
                                                           class="mr-sm-2">Deadline
                                                    </label>
                                                    <input type="date" id="deadline" class="form-control" name="deadline">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="project_id"
                                                       class="control-label">Assign Project</label>
                                                <select name="project_id" class="custom-select" >
                                                    <!--placeholder-->
                                                    <option value="" selected
                                                            disabled>Select Project
                                                    </option>
                                                    @foreach ($prjects as $prject)
                                                        <option value="{{ $prject->id }}"> {{ $prject->project_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>

                                            <div class="col">
                                                <label for="inputName"
                                                       class="control-label">Assign User</label>
                                                <select name="user_id" class="custom-select" >
                                                    <!--placeholder-->
                                                    <option value="" selected
                                                            disabled>Select User
                                                    </option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"> {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                             <br>



                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>Close</button>
                                            <button type="submit"
                                                    class="btn btn-success">submit</button>
                                        </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>



    </div>
@endsection
@section('js')

@endsection
