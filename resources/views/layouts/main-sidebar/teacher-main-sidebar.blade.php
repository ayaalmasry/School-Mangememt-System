<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
    <a href="{{ url('/teacher-dashboard') }}">
        <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main.TeacherDasboard')}}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
                   <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main.Programname')}} </li>

        <!-- الطلاب-->
        <li>
            <a href="{{route('Students.index')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{trans('main.students')}}</span></a>
        </li>
                    <!-- الاختبارات-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{trans('main.Quizzes')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('quiz.index')}}">{{trans('main.ListQuizzes')}} </a></li>
                  </ul>

        </li>
                    
                    
                    
                     <!-- Online classes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                            <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('main.Onlineclasses')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('zoom.index')}}">{{trans('main.Direct contact with Zoom')}}</a> </li>
                          
                        </ul>
                    </li>



        

                    <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu1">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{trans('main.Report')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu1" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('attendance_report')}}">{{trans('main.AttendanceReport')}}</a></li>
                <li><a href="#">{{trans('main.QuizzesReport')}}</a></li>
            </ul>

        </li>
                    
                    <!-- الملف الشخصي-->
        <li>
            <a href="{{route('profile.show')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text"> {{trans('main.profile')}}</span></a>
        </li>
         

             </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================