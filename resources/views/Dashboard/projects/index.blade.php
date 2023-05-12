@extends('layouts.master')
@section('css')

    @section('title')
        Projects
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Projects</h4>
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
                        Add Project <i class="fa fa-plus"></i>
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
                                <th>Project Name</th>
                                <th>deadline</th>
                                <th>Client Name</th>
                                <th>User Name</th>
                                <th>Process</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($projects as $project)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$project->project_name }}</td>
                                    <td>{{$project->deadline}}</td>
                                    <td>{{$project->client->name}}</td>
                                     <td>{{$project->user->name}}</td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $project->id }}"
                                                title="edit_Client"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{$project->id}}"
                                                title="Soft delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <!-- edit model projects -->
                                <div class="modal fade" id="edit{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    Edit  project {{$project->project_name}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form class=" row mb-30" action="{{route('project.update','test')}}" method="POST">
                                                    {{method_field('patch')}}
                                                    @csrf

                                                    <div class="card-body">
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $project->id }}">

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="project_name"
                                                                       class="mr-sm-2">Title
                                                                </label>
                                                                <input id="project_name" type="text" name="project_name" required class="form-control" value="{{$project->project_name}}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="deadline"
                                                                       class="mr-sm-2">Deadline
                                                                </label>
                                                                <input type="date" id="deadline" class="form-control" name="deadline" value="{{$project->deadline}}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label
                                                                for="exampleFormControlTextarea1">Description
                                                                :</label>
                                                            <textarea class="form-control" name="description"
                                                                      id="exampleFormControlTextarea1"
                                                                      rows="3">
                                                                            {{$project->description}}
                                                            </textarea>
                                                        </div>

                                                        <div class="col">
                                                            <label for="inputName"
                                                                   class="control-label">Assign User</label>
                                                            <select name="user_id" class="custom-select" >
                                                                <!--placeholder-->
                                                                <option value="" selected
                                                                        disabled>Select User
                                                                </option>
                                                                @isset($users)
                                                                    @foreach ($users as $user)>
                                                                        <option value="{{$user->id}}" @if($project->user->id == $user->id) selected @endif >{{ $user->name}}</option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div class="col">
                                                            <label for="inputName"
                                                                   class="control-label">Assign Client</label>
                                                            <select name="client_id" class="custom-select" >
                                                                <!--placeholder-->
                                                                <option value="" selected
                                                                        disabled>Select client
                                                                </option>
                                                                @isset($clients)
                                                                    @foreach ($clients as $client)
                                                                        <option value="{{$client -> id}}" @if($project->client->id == $client->id) selected @endif >{{ $client->name}}</option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                        </div>
                                                        <br>

                                                        <div class="col">
                                                            <label for="inputName"
                                                                   class="control-label">Status</label>
                                                            <select name="status" class="custom-select" >
                                                                <!--placeholder-->

                                                                <option value="open" @if($project->status == "open") selected @endif>open</option>
                                                                <option value="close" @if($project->status == "close") selected  @endif>close</option>
                                                            </select>
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

                                <!-- delete model projects -->
                                <div class="modal fade" id="delete{{ $project->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    Delete Project
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('project.destroy','test')}}" method="post">
                                                    {{method_field('Delete')}}
                                                    @csrf
                                                    .! Warning You are delete project {{ $project->project_name }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $project->id }}">
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

        <!-- add_modal_Client -->
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

                        <form class=" row mb-30" action="{{route('project.store')}}"method="POST">
                            @csrf
                            <div class="card-body">

                                            <div class="row">
                                                <div class="col">
                                                    <label for="project_name "
                                                           class="mr-sm-2">Title
                                                    </label>
                                                    <input id="name" type="text" name="project_name" required class="form-control" value="{{old('project_name ')}}">
                                                </div>
                                                <div class="col">
                                                    <label for="deadline"
                                                           class="mr-sm-2">Deadline
                                                    </label>
                                                    <input type="date" id="deadline" class="form-control" name="deadline">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label
                                                    for="exampleFormControlTextarea1">Description
                                                :</label>
                                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                                          rows="3">

                                                </textarea>
                                            </div>

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
                                            <div class="col">
                                                <label for="inputName"
                                                       class="control-label">Assign Client</label>
                                                <select name="client_id" class="custom-select" >
                                                    <!--placeholder-->
                                                    <option value="" selected
                                                            disabled>Select client
                                                    </option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}"> {{ $client->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                             <br>

                                            <div class="col">
                                                <label for="inputName"
                                                       class="control-label">Status</label>
                                                <select name="status" class="custom-select" >
                                                    <!--placeholder-->
                                                    <option value="open">open</option>
                                                    <option value="close">close</option>
                                                </select>
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



    </div>
@endsection
@section('js')

@endsection
