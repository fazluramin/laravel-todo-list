{{-- For Custom Register--}}

@extends ('layouts.app.app')


{{-- For Pre-defined Register--}}
{{--
@extends ('layouts.app')
--}}

@section('title')
    Register Page
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{asset("asset/assets/images/background/login-register.jpg")}})">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" method="POST" action="{{route('post.register')}}" >
                        
                        @csrf

                        <h3 class="box-title m-b-20">Register</h3>
                        
                        @include ('layouts.app.flash_message')

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input  class="form-control @error('name') is-invalid @enderror" 
                                        type="text" 
                                        name="name" 
                                        required="" 
                                        placeholder="Name"
                                        value="{{ old('name') }}" 
                                        required autocomplete="name" 
                                        autofocus>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input  class="form-control  @error('email') is-invalid @enderror" 
                                        type="text" 
                                        name="email" 
                                        required="" 
                                        value="{{ old('email') }}"
                                        placeholder="Email">
                            </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input  class="form-control @error('password') is-invalid @enderror" 
                                        type="password" 
                                        name="password" 
                                        required="" 
                                        
                                        placeholder="Password" 
                                        required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input  class="form-control" 
                                        type="password" 
                                        name="password_confirmation" 
                                        required="" 
                                        
                                        placeholder="Confirm Password" 
                                        required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <div>Already have an account? <a href="{{route ('login')}}" class="text-info m-l-5"><b>Sign In</b></a></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@push('script')
    <script>
        $(document).ready(function(){
            setTimeout(function() {
                $('.alert').slideUp(1000);
            }, 4000);
        console.log();
        });
    </script>
@endpush

@endsection
