@extends('layouts.app.layouts')


@section('title')

    Manage Admin Account

@endsection


@include('layouts.app.sidebar')

@section('content')

<div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User Account</h4>
                    <form class="m-t-40" action="{{route('admin.update.users')}}" method="POST">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <h5>Full Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                
                                <input type="hidden" name="id" class="form-control" value="{{$id->id}}">
                                <input  type="text" name="fullname" class="form-control" value="{{$id->full_name}}" 
                                        required data-validation-required-message="This field is required"> </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Email Field <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="email" name="email" class="form-control" value="{{$id->email}}"
                                required data-validation-required-message="This field is required"> </div>
                        </div>
                        
    
                        <div class="text-xs-right float-right">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-inverse">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection