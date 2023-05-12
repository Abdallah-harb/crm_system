@extends('layouts.master')
@section('css')

    @section('title')
        Clents
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Add New Client</h4>
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
                        Add Client <i class="fa fa-plus"></i>
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
                                <th>Name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>iamge</th>
                                <th>Process</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($clients as $client)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>
                                        @if(isset($client->image))
                                        <img src="{{ URL::asset('assets/images/clients/'.$client->image)}}"
                                             class="img-fluid"  style="width: 50px;height: 50px"
                                             alt="Responsive image">
                                        @else
                                            <img src="{{ URL::asset('assets/images/clients/download.jpg')}}"
                                                 class="img-fluid"  style="width: 50px;height: 50px"
                                                 alt="Responsive image">
                                        @endif

                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $client->id }}"
                                                title="edit_Client"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $client->id }}"
                                                title="Soft delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $client->id  }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    Edit Client
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{route('client.update','test')}}" method="post" enctype="multipart/form-data">
                                                    {{method_field('patch')}}
                                                    @csrf
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $client->id }}">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name"
                                                                   class="mr-sm-2">Name
                                                            </label>
                                                            <input id="name" type="text" name="name" required class="form-control" value="{{$client->name}}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="email"
                                                                   class="mr-sm-2">email
                                                            </label>
                                                            <input type="email" class="form-control" name="email" required value="{{$client->email}}">
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="image"
                                                                   class="mr-sm-2">current image
                                                            </label>

                                                            @if(isset($client->image))
                                                                <img src="{{ URL::asset('assets/images/clients/'.$client->image)}}"
                                                                     class="img-fluid"  style="width: 50px;height: 50px"
                                                                     alt="Responsive image">
                                                            @else
                                                                <img src="{{ URL::asset('assets/images/clients/download.jpg')}}"
                                                                     class="img-fluid"  style="width: 50px;height: 50px"
                                                                     alt="Responsive image">
                                                            @endif

                                                        </div>
                                                        <div class="col">
                                                            <label for="image"
                                                                   class="mr-sm-2">New image
                                                            </label>
                                                            <input type="file" id="file" name="image">
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="phone"
                                                                   class="mr-sm-2">Phone
                                                            </label>
                                                            <input id="text" type="text" name="phone" required class="form-control" value="{{$client->phone}}">
                                                        </div>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>Close</button>
                                                        <button type="submit"
                                                                class="btn btn-success">submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- grade delete model -->
                                <div class="modal fade" id="delete{{ $client->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    Delete Client
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('client.destroy','test')}}" method="post">
                                                    {{method_field('Delete')}}
                                                    @csrf
                                                    .! Warning You are delete {{ $client->name }} Client
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $client->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>Close</button>
                                                        <button type="submit"
                                                                class="btn btn-success">submit</button>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            Add client
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="name"
                                           class="mr-sm-2">Name
                                        </label>
                                    <input id="name" type="text" name="name" required class="form-control" value="{{old('name')}}">
                                </div>
                                <div class="col">
                                    <label for="email"
                                           class="mr-sm-2">email
                                        </label>
                                    <input type="email" class="form-control" name="email" required value="{{old('email')}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="phone"
                                           class="mr-sm-2">Phone
                                        </label>
                                    <input id="text" type="text" name="phone" class="form-control" required value="{{old('phone')}}">
                                </div>
                                <div class="col">
                                    <label for="image"
                                           class="mr-sm-2">image
                                        </label>
                                    <input type="file" class="form-control" name="image"  value="{{old('image')}}">
                                </div>
                            </div>
                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>Close</button>
                        <button type="submit"
                                class="btn btn-success">submit</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')

@endsection
