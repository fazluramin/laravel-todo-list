@extends('layouts.layouts')
@section('title')
@endsection

@include('layouts.sidebar')

@section('content')

<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">My Account</h4>
            <form class="m-t-40" action="{{route('admin.post.profile.admins')}}" method="POST">
                    
                    {{ csrf_field() }}
                
                    <div class="form-group">
                        <h5>Full Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                            <input type="text" name="fullname" value="{{Auth::user()->full_name}}" class="form-control" required data-validation-required-message="This field is required"> </div>
                        
                    </div>
                    <div class="form-group">
                        <h5>Email Field <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" disabled> </div>
                    </div>
                    <div class="form-group">
                        <h5>New Password<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="password" name="password" class="form-control"> </div>
                    </div>
                    <div class="form-group">
                        <h5>Confirm Password<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="password" name="password_confirmation" class="form-control"> 
                        </div>
                    </div>
                    <div class="form-group">
                            <input type="checkbox" id="md_checkbox_3" class="agree chk-col-purple" unchecked />
                            <label for="md_checkbox_3">Update My Password</label>
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

@push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('form input[type="password"]').prop("disabled", true);
            $(".agree").click(function(){
                if($(this).prop("checked") == true){
                    $('form input[type="password"]').prop("disabled", false);
                    $('form input[type="submit"]').prop("disabled", false);
                }
                else if($(this).prop("checked") == false){
                    $('form input[type="password"]').prop("disabled", true);
                    $('form input[type="submit"]').prop("disabled", true);
                }
            });
        });
    </script>
@endpush
    
@endsection