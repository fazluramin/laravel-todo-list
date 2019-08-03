@extends('layouts.app.layouts')

@section('title')

    Reset User Password

@endsection

@include('layouts.app.sidebar')

@section('content')

<div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form class="floating-labels m-t-40" action="{{ route('admin.reset') }}" method="POST">
                        
                        {{ csrf_field() }}

                        <div class="form-group m-b-40">
                            <input type='hidden' name="id" value='{{$data->id}}'>
                            <input type="password" name="password" class="form-control" id="input2">
                            <span class="bar"></span>
                            <label for="input2">New Password</label>
                        </div>
                        <div class="form-group m-b-40">
                            <input type="password" name="pasword_confirmation" class="form-control" id="input2">
                            <span class="bar"></span>
                            <label for="input2">Confirm Password</label>
                        </div>
                        <div class='float-right'>
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-info">
                            <i class="ti-save"></i> Save Password
                        </button>
                        <button type="reset" class="btn waves-effect waves-light btn-rounded btn-outline-warning">
                                <i class="ti-reload"></i> Clear Form 
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection