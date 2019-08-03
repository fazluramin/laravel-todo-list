@extends('layouts.app.layouts')
@section('title')
    Dashboard Page
@endsection

@include('pages.admin.sidebar')

@section('content')

<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Admin Account</h4>
                <form class="m-t-40" action="" method="">
                    <div class="form-group">
                        <h5>Full Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="text" class="form-control" required data-validation-required-message="This field is required"> </div>
                        
                    </div>
                    <div class="form-group">
                        <h5>Email Field <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="email" name="email" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                    <div class="form-control-feedback"><small>The <code> Password </code>Will be Sent to the Email.</small></div>

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