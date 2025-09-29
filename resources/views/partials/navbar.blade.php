<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>AHRMD-Projects</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('css/feather.css')}}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

  </head>
   
 
  <body class="vertical  light">
    <div class="wrapper">
    
      <nav class="topnav navbar navbar-light d-flex align-items-center justify-content-between">
          <!-- Left: Sidebar toggle -->
          <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
              <i data-feather="home"></i>
              <i class="fe fe-menu navbar-toggler-icon"></i>
          </button>

          <!-- Center: Project Title -->
          <div class="mx-auto text-center my-4">
              <span class="h3 mb-0 fw-bold text-uppercase position-relative" style="
                  display: inline-block;
                  padding-bottom: 6px;
                  color: #000;
                  text-shadow: 
                      1px 1px 0 #ccc, 
                      1px 1px 0 #bbb, 
                      1px 1px 0 #aaa, 
                      2px 2px 0 #999;
              ">
                  AHRMD Project Management System
              </span>
          </div>

          <!-- Right: Notifications & User -->
          <ul class="nav align-items-center">
             
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-muted pr-0 d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                      @php
                          $user = Auth::user();
                          $initials = strtoupper(substr($user->firstname, 0, 1) . substr($user->lastname, 0, 1));
                      @endphp

                      <div class="avatar avatar-sm d-flex align-items-center justify-content-center rounded-circle text-white"
                          style="background-color: #{{ substr(md5($user->email), 0, 6) }}; width: 40px; height: 40px;">
                          <strong>{{ $initials }}</strong>
                      </div>

                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="{{ route('password.change') }}">Change Password</a>
                      <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                  </div>
              </li>
          </ul>
      </nav>

      <aside class="sidebar-left border-right bg-grey shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">

          <div class="w-100 mb-1 d-flex justify-content-center align-items-center">
              <a class="navbar-brand " href="{{ url('/') }}">
                  <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img" style="height: 80px;">
              </a>
          </div>

         
          @if(Auth::user()->role->name == 'Admin')
            <ul class="navbar-nav flex-fill w-100">
              <li class="nav-item w-100">
                <a href="{{ url('/dashboard') }}" class="nav-link">
                   <img src="{{ asset('images/icons/dashboard.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          @endif
          @if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Project Manager')
            @if(Auth::user()->role->name == 'Project Manager')
              <ul class="navbar-nav flex-fill w-100">
                <li class="nav-item w-100">
                  <a href="{{ url('/dashboardpm') }}" class="nav-link">
                   <img src="{{ asset('images/icons/dashboard.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                  </a>
                </li>
              </ul>
            @endif
            <p class="text-maroon nav-heading mt-4 mb-1" style="font-weight: bold; font-size: 1.1em;">
              <span>Projects Management</span>
            </p>

              <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                  <a href="{{ url('/projects/create') }}" class="nav-link">
                   <img src="{{ asset('images/icons/aproject.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <span class="ml-3 item-text">New Project</span>
                  </a>
                </li>
              </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a href="{{ url('/allprojects') }}" class="nav-link d-flex align-items-center">
                   <img src="{{ asset('images/icons/allprojectsgreen.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">All Projects</span>
                </a>
                @if(isset($totalProjects))
                  <span class="badge badge-pill bg-green text-white mr-3 pt-2 pb-2">
                    {{ $totalProjects }}
                  </span>
                @endif 
              </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a href="{{ url('/hrmprojects') }}" class="nav-link d-flex align-items-center">
                   <img src="{{ asset('images/icons/hrmprojects.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">HRM Projects</span>
                </a>
                @if(isset($totalProjectsHRM))
                  <span class="badge badge-pill bg-yellow text-white mr-3 pt-2 pb-2">
                    {{ $totalProjectsHRM }}
                  </span>
                @endif 
              </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a href="{{ url('/adminprojects') }}" class="nav-link d-flex align-items-center">
                   <img src="{{ asset('images/icons/adminprojects.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">Admin Projects</span>
                </a>
                @if(isset($totalProjectsAdmin))
                  <span class="badge badge-pill bg-maroon text-white mr-3 pt-2 pb-2">
                    {{ $totalProjectsAdmin }}
                  </span>
                @endif 
              </li>
            </ul>

            <p class="text-maroon nav-heading mt-4 mb-1" style="font-weight: bold; font-size: 1.1em;">
              <span>Reports Management</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                  <a class="nav-link d-flex align-items-center" href="{{ url('/reports') }}">
                   <img src="{{ asset('images/icons/reports.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <span class="ml-3 item-text">Reports</span>
                  </a>
                  {{-- @if(isset($totalReports))
                    <span class="badge badge-pill bg-green text-white mr-3 pt-2 pb-2">
                      {{ $totalReports }}
                    </span>
                  @endif  --}}
              </li>
            </ul>
        
            <p class="text-maroon nav-heading mt-4 mb-1" style="font-weight: bold; font-size: 1.1em;">
              <span>Tasks Management</span>
            </p>
            
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a href="{{ url('/alltasks') }}" class="nav-link d-flex align-items-center">
                   <img src="{{ asset('images/icons/alltasks.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">All Tasks</span>
                </a>
                @if(isset($totalTasks))
                  <span class="badge badge-pill bg-yellow text-white mr-3 pt-2 pb-2">
                    {{ $totalTasks }}
                  </span>
                @endif 
              </li>
              @if(Auth::user()->role->name == 'Admin')
                <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                  <a href="{{ url('/hrmtasks') }}" class="nav-link d-flex align-items-center">
                    <img src="{{ asset('images/icons/hrmtasks.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <span class="ml-3 item-text">HRM Tasks</span>
                  </a>
                  @if(isset($totalTasksHRM))
                    <span class="badge badge-pill bg-maroon text-white mr-3 pt-2 pb-2">
                      {{ $totalTasksHRM }}
                    </span>
                  @endif 
                </li>

                <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                  <a href="{{ url('/admintasks') }}" class="nav-link d-flex align-items-center">
                    <img src="{{ asset('images/icons/admintasks.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <span class="ml-3 item-text">Admin Tasks</span>
                  </a>
                    @if(isset($totalTasksAdmin))
                      <span class="badge badge-pill bg-gold text-white mr-3 pt-2 pb-2">
                        {{ $totalTasksAdmin }}
                      </span>
                    @endif 
                </li>
                @endif
            </ul>
           
            <p class="text-maroon nav-heading mt-4 mb-1" style="font-weight: bold; font-size: 1.1em;">
              <span>User Management</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2 d-flex justify-content-between align-items-center">
              <li class="nav-item w-100">
                  <a class="nav-link" href="{{ url('/users/create') }}">
                   <img src="{{ asset('images/icons/adduser.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <span class="ml-3 item-text">New user</span>
                  </a>
              </li>
            </ul>
            <ul class="navbar-nav flex-fill">
              <li class="nav-item w-100 mb-2 d-flex justify-content-between align-items-center">
                  <a class="nav-link d-flex align-items-center" href="{{ url('/users') }}">
                   <img src="{{ asset('images/icons/listusers.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <span class="ml-3 item-text">List Users</span>
                  </a>
                  @if(isset($totalUsers))
                      <span class="badge badge-pill bg-maroon text-white mr-3 pt-1 pb-1">
                          {{ $totalUsers }}
                      </span>
                  @endif         
              </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100">
                  <a class="nav-link" href="{{ url('roles') }}">
                   <img src="{{ asset('images/icons/roles.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <span class="ml-3 item-text">Roles</span>
                  </a>
              </li>   
            </ul>
           
          @endif       
          
            @if(Auth::user()->role->name == 'Project Manager Assistant' || Auth::user()->role->name == 'Member')
            {{-- @if(Auth::user()->role->name == 'Project Manager Assistant' || Auth::user()->role->name == 'Member') --}}
                <ul class="navbar-nav flex-fill w-100 mb-2">
                  <li class="nav-item w-100">
                    <a href="{{ url('/dashboardpma') }}" class="nav-link">
                   <img src="{{ asset('images/icons/dashboard.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                    </a>
                  </li>
                </ul>
              {{-- @endif --}}
            <p class="text-maroon nav-heading mt-4 mb-1" style="font-weight: bold; font-size: 1.1em;">
              <span>Projects Management</span>
            </p>
            
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a href="{{ url('/allprojects') }}" class="nav-link d-flex align-items-center">
                   <img src="{{ asset('images/icons/allprojectsgreen.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">All Projects</span>
                </a>
                @if(isset($totalProjects))
                  <span class="badge badge-pill bg-green text-white mr-3 pt-1 pb-1">
                    {{ $totalProjects }}
                  </span>
                @endif 
              </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a href="{{ url('/hrmprojects') }}" class="nav-link d-flex align-items-center">
                   <img src="{{ asset('images/icons/hrmprojects.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">HRM Projects</span>
                </a>
                @if(isset($totalProjectsHRM))
                  <span class="badge badge-pill bg-yellow text-white mr-3 pt-1 pb-1">
                    {{ $totalProjectsHRM }}
                  </span>
                @endif 
              </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a href="{{ url('/adminprojects') }}" class="nav-link d-flex align-items-center">
                   <img src="{{ asset('images/icons/adminprojects.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">Admin Projects</span>
                </a>
                @if(isset($totalProjectsAdmin))
                  <span class="badge badge-pill bg-maroon text-white mr-3 pt-1 pb-1">
                    {{ $totalProjectsAdmin }}
                  </span>
                @endif 
              </li>
            </ul>
        
            <p class="text-maroon nav-heading mt-4 mb-1" style="font-weight: bold; font-size: 1.1em;">
              <span>Tasks Management</span>
            </p>
           
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a href="{{ url('/alltasks') }}" class="nav-link d-flex align-items-center">
                   <img src="{{ asset('images/icons/alltasks.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                  <span class="ml-3 item-text">All Tasks</span>
                </a>
                <span class="badge badge-pill bg-yellow text-white mr-3 pt-1 pb-1">12</span>
              </li>
            </ul>
           
          @endif 

        </nav>
      </aside>
    </div> <!-- .wrapper -->
   
  </body>
</html>
