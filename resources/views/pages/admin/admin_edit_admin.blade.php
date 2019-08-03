@extends('layouts.app.layouts')
@section('title')
    Dashboard Page
@endsection

@include('layouts.app.sidebar')

@section('content')

<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Admin Account</h4>
            <form class="m-t-40" action="{{route('admin.update.admins')}}" method="post">
                    
                    {{ csrf_field() }}
                
                    <div class="form-group">
                        <h5>Full Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="hidden" name="id" value="{{$id->id}}">
                            <input type="text" name="fullname" value="{{$id->full_name}}" class="form-control" required data-validation-required-message="This field is required"> </div>
                        
                    </div>
                    <div class="form-group">
                        <h5>Email Field <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="email" name="email" value="{{$id->email}}" class="form-control" required data-validation-required-message="This field is required"> </div>
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