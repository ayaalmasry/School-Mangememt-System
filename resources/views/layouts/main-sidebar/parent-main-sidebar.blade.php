<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
    <a href="{{ url('/dashboard') }}">
        <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main.parent Dashboard')}}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main.Programname')}} </li>

                    <!-- child-->
        <li>
            <a href="{{route('sons.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('main.child')}}</span></a>
        </li>
                    
                           <!-- attendance-->
        <li>
            <a href="{{route('sons.attendanceschild')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('main.Attendance')}}</span></a>
        </li>
                    
                           <!-- report-->
        <li>
            <a href="{{route('sons.feesparent')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('main.InvoicesReport')}}</span></a>
        </li>





        <!-- Settings-->
        <li>
            <a href="{{route('profileparent.show')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('main.profile')}} </span></a>
        </li>


                   
                  
                    
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================