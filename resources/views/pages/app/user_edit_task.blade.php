@extends('layouts.app.layouts')


@section('title')

    Edit User Task

@endsection


@include('layouts.app.sidebar')

@section('content')

<div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User Task</h4>
                    <form class="m-t-40" action="{{route('user.update.task')}}" method="POST">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <h5>Task Description <span class="text-danger">*</span></h5>
                            <div class="controls">
                                
                                <input type="hidden" name="id" class="form-control" value="{{$id->id}}">
                                <input  type="text" name="desc" class="form-control" value="{{$id->description}}" 
                                        required data-validation-required-message="This field is required"> </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Time Scheduled <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input  type="text" id="min-date" name='scheduled' 
                                        class="form-control" 
                                        value="{{$id->scheduled}}" required> 
                            </div>
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