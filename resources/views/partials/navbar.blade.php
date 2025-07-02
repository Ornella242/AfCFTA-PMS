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
  </head>
   
 
  <body class="vertical  light">
    <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
            <i data-feather="home"></i>
            <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
     
        <ul class="nav">
          <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
              <span class="fe fe-bell fe-16"></span>
              <span class="dot dot-md bg-success"></span>
            </a>
          </li>
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
              <a class="dropdown-item" href="{{ route('password.change') }}">
                  Change Password
              </a>

              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Log out
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>

        </li>
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-grey shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex align-items-center">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-brand-img brand-md logo-img">
                    <span class="ms-2 fw-bold text-dark h5 mb-0">AHRMD Projects</span>
                </a>
         </div>
        @if(Auth::user()->role->name == 'Admin')
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a href="{{ url('/dashboard') }}" class="nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
        @endif
        @if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Project Manager')
          <p class="text-maroon nav-heading mt-4 mb-1">
            <span>Projects Management</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a href="{{ url('/projects/create') }}" class="nav-link">
                <i class="fe fe-plus-circle fe-16"></i>
                <span class="ml-3 item-text text-black">New Project</span>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/allprojects') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-box fe-16"></i>

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
                <i class="fe fe-users fe-16"></i>
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
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text">Admin Projects</span>
              </a>
               @if(isset($totalProjectsAdmin))
                <span class="badge badge-pill bg-maroon text-white mr-3 pt-2 pb-2">
                  {{ $totalProjectsAdmin }}
                </span>
              @endif 
            </li>
          </ul>
      
          <p class="text-maroon nav-heading mt-4 mb-1">
            <span>Tasks Management</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/newtask') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-plus-circle fe-16"></i>
                <span class="ml-3 item-text">New Task</span>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/alltasks') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">All Tasks</span>
              </a>
              <span class="badge badge-pill bg-yellow text-white mr-3 pt-1 pb-1">12</span>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/hrmtasks') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">HRM Tasks</span>
              </a>
              <span class="badge badge-pill bg-maroon text-white mr-3 pt-1 pb-1">5</span>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/admintasks') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text ">Admin Tasks</span>
              </a>
              <span class="badge badge-pill bg-green text-white mr-3 pt-1 pb-1">7</span>
            </li>
          </ul>
          <p class="text-maroon nav-heading mt-4 mb-1">
            <span>Reports Management</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
                <a class="nav-link d-flex align-items-center" href="{{ url('/reports') }}">
                  <i class="fe fe-book fe-16"></i>
                  <span class="ml-3 item-text">Reports</span>
                </a>
                <span class="badge badge-pill bg-yellow text-white mr-3 pt-1 pb-1">16</span>
            </li>
          </ul>
          <p class="text-maroon nav-heading mt-4 mb-1">
            <span>User Management</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2 d-flex justify-content-between align-items-center">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('/users/create') }}">
                  <i class="fe fe-plus-circle fe-16"></i>
                  <span class="ml-3 item-text">New user</span>
                </a>
            </li>
          </ul>
           <ul class="navbar-nav flex-fill">
            <li class="nav-item w-100 mb-2 d-flex justify-content-between align-items-center">
                <a class="nav-link d-flex align-items-center" href="{{ url('/users') }}">
                  <i class="fe fe-users fe-16"></i>
                  <span class="ml-3 item-text">List Users</span>
                </a>
                @if(isset($totalUsers))
                    <span class="badge badge-pill bg-green text-white mr-3 pt-1 pb-1">
                        {{ $totalUsers }}
                    </span>
                @endif         
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('roles') }}">
                  <i class="fe fe-shield fe-16"></i>
                  <span class="ml-3 item-text">Roles</span>
                </a>
            </li>
            {{-- <li class="nav-item w-100">
                <a class="nav-link" href="widgets.html">
                  <i class="fe fe-lock fe-16"></i>
                  <span class="ml-3 item-text">Permissions</span>
                </a>
            </li> --}}
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Settings</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="{{ url('logs') }}">
                  <i class="fe fe-activity fe-16"></i>
                  <span class="ml-3 item-text">Logs</span>
                </a>
            </li>
          </ul>
        @endif       
        
      
        @if(Auth::user()->role->name == 'Member')
          <p class="text-maroon nav-heading mt-4 mb-1">
            <span>Projects Management</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a href="{{ url('/addnewproject') }}" class="nav-link">
                <i class="fe fe-plus-circle fe-16"></i>
                <span class="ml-3 item-text text-black">New Project</span>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/allprojects') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-box fe-16"></i>
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
                <i class="fe fe-users fe-16"></i>
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
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text">Admin Projects</span>
              </a>
              @if(isset($totalProjectsAdmin))
                <span class="badge badge-pill bg-maroon text-white mr-3 pt-1 pb-1">
                   {{ $totalProjectsAdmin }}
                </span>
              @endif 
            </li>
          </ul>
      
          <p class="text-maroon nav-heading mt-4 mb-1">
            <span>Tasks Management</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/newtask') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-plus-circle fe-16"></i>
                <span class="ml-3 item-text">New Task</span>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/alltasks') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">All Tasks</span>
              </a>
              <span class="badge badge-pill bg-yellow text-white mr-3 pt-1 pb-1">12</span>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/hrmtasks') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">HRM Tasks</span>
              </a>
              <span class="badge badge-pill bg-maroon text-white mr-3 pt-1 pb-1">5</span>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 d-flex justify-content-between align-items-center">
              <a href="{{ url('/admintasks') }}" class="nav-link d-flex align-items-center">
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text ">Admin Tasks</span>
              </a>
              <span class="badge badge-pill bg-green text-white mr-3 pt-1 pb-1">7</span>
            </li>
          </ul>
        @endif 

      </nav>
      </aside>
    </div> <!-- .wrapper -->
    <!-- Loader -->
    {{-- <div id="loader-wrapper">
        <div id="loader"></div>
    </div> --}}


  </body>
</html>
