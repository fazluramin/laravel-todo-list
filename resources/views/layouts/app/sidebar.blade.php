@section('sidebar')

@if (Auth::user()->user_type_id==2)
<!-- Sidebar navigation-->
<nav class="sidebar-nav">
    <ul id="sidebarnav">
         <li class="nav-devider"></li>
        <li class="nav-small-cap">MAIN MENU</li>
        <li> 
            <a class="has-arrow waves-effect waves-dark" href="{{route('user.dashboard')}}" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Dashboard 
                    <!--<span class="label label-rouded label-themecolor pull-right">4</span>-->
                </span>
            </a>
        </li>
        
        <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('user.task') }}" aria-expanded="false">
                <i class="mdi mdi-bullseye"></i>
                    <span class="hide-menu">My Todo List 
                        <!--<span class="label label-rouded label-danger pull-right">25</span>-->
                    </span>
                </a>
        </li>
        <!--<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
            <i class="mdi mdi-chart-bubble"></i>
                <span class="hide-menu">My Account 
                    
                </span>
            </a>
        </li>-->
    </ul>
</nav>
<!-- End Sidebar navigation -->

@elseIf(Auth::user()->user_type_id==1)

<!-- Sidebar navigation-->
<nav class="sidebar-nav">
        <ul id="sidebarnav">
             <li class="nav-devider"></li>
            <li class="nav-small-cap">MAIN MENU</li>
            <li> 
                <a class="has-arrow waves-effect waves-dark" href="{{route('admin.dashboard')}}" aria-expanded="false">
                    <i class="mdi mdi-gauge"></i>
                    <span class="hide-menu">Dashboard 
                        
                    </span>
                </a>
            </li>
            <li class="nav-devider"></li>
            <li class="nav-small-cap">MANAGE ACCOUNT</li>
            <li> <a class="has-arrow waves-effect waves-dark" href="{{route('admin.man.admins')}}" aria-expanded="false">
                    <i class="mdi mdi-bullseye"></i>
                        <span class="hide-menu">ADMIN
                            
                        </span>
                    </a>
            </li>
    
            <li> <a class="has-arrow waves-effect waves-dark" href="{{route('admin.man.users')}}" aria-expanded="false">
                <i class="mdi mdi-chart-bubble"></i>
                    <span class="hide-menu">USER</span>
                </a>
            </li>
            <li class="nav-devider"></li>
            <li class="nav-small-cap">PROFILE</li>
            <li> <a class="has-arrow waves-effect waves-dark" href="{{route('admin.profile.admins')}}" aria-expanded="false">
                <i class="mdi mdi-chart-bubble"></i>
                    <span class="hide-menu">My Account</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
        
@endIf
@endsection