@section('sidebar')

<!-- Sidebar navigation-->
<nav class="sidebar-nav">
    <ul id="sidebarnav">
         <li class="nav-devider"></li>
        <li class="nav-small-cap">MAIN MENU</li>
        <li> 
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">Dashboard 
                    <span class="label label-rouded label-themecolor pull-right">4</span>
                </span>
            </a>
        </li>
        
        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-bullseye"></i>
                    <span class="hide-menu">My Todo List 
                        <span class="label label-rouded label-danger pull-right">25</span>
                    </span>
                </a>
        </li>

        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
            <i class="mdi mdi-chart-bubble"></i>
                <span class="hide-menu">My Account 
                    
                </span>
            </a>
        </li> 
    </ul>
</nav>
<!-- End Sidebar navigation -->
    
@endsection