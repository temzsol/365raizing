<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">All Details</li>

                <li>
                    <a href="{{url('/admin/dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Task Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-vertical">My Task</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="#" key="t-light-sidebar">My Assign Task</a></li>
                                <li><a href="#" key="t-compact-sidebar">Update Assign Task</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Brand & Company</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <li><a href="#}" key="t-light-sidebar">All Brand </a></li>
                            <li><a href="#}" key="t-light-sidebar">Add & Update Brand </a></li>
                            <li><a href="{{route('company.index')}}" key="t-compact-sidebar">All Company</a></li>
                            <li><a href="{{route('company.create')}}" key="t-compact-sidebar">Add & Update Company</a></li>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">HR Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Employee Data Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Job Opening Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Applicants Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Employee Training Data</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Benefit Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Documents Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Project Tracking</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Access from Devices</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Company info Management</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Setup Password Protection</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">HR Manager Reminder</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Employee Attendance Methods</a></li>
                        <li><a href="{{url('/admin/contents')}}" key="t-tui-content">Common offer letter</a></li>
                        
                       
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Web Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('/admin/settings')}}" key="t-tui-calendar">Website Settings</a></li>
                        <li><a href="{{url('/admin/settings/create')}}" key="t-full-calendar">Update Web Settings</a></li>
                        
                    </ul>
                </li>

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->