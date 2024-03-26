@extends('layout')
@section('content')
    <br>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-danger">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputName1"
                                               placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Email address</label>
                                        <input name="email" type="email" class="form-control" id="exampleInputEmail6"
                                               placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword4">Password</label>
                                        <input name="password" type="password" class="form-control"
                                               id="exampleInputPassword4" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Status</label>
                                        <select class="form-control" id="exampleSelectGender">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Role</label>
                                        <select class="form-control" id="exampleSelectGender" onchange="updateUserType(this)">
                                            <option value="" selected>Chọn Role phù hợp</option>
                                            @foreach($roles as $itemRole)
                                                @if($itemRole->role_id != 1)
                                                    <option value="{{$itemRole->role_name}}">{{$itemRole->role_id}} -- {{$itemRole->role_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">User Type</label>
                                        <input type="text" name="user_type" class="form-control" id="exampleInputEmail3" placeholder="User Type" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>File upload</label>
                                        <input type="file" name="img[]" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled
                                                   placeholder="Upload Image">
                                            <span class="input-group-append">
                                         <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCity1">Phone</label>
                                        <input type="text" name="phone_number" class="form-control" id="exampleInputCity1"
                                               placeholder="Location">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a href="{{route('Users.list-user')}}" class="btn btn-light">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
