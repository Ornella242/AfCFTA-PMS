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
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="./assets/avatars/face-5.jpg" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Log out</a>
              
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
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-brand-img brand-md">
                    <span class="ms-2 fw-bold text-dark h5 mb-0">AHRMD Projects</span>
                </a>
         </div>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="{{ url('/dashboard') }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Projects Management</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#ui-projects" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">Projects</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="ui-projects">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{ url('/allprojects') }}"><span class="ml-1 item-text">All projects</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{ url('/adminprojects') }}"><span class="ml-1 item-text">Admin projects</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{ url('/hrmprojects') }}"><span class="ml-1 item-text">HRM projects</span></a>
                </li>
            </li>
          </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
              <li class="nav-item dropdown">
                <a href="#ui-tasks" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                  <i class="fe fe-layers fe-16"></i>
                  <span class="ml-3 item-text">Tasks</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="ui-tasks">
                  <li class="nav-item">
                    <a class="nav-link pl-3" href="{{ url('/alltasks') }}"><span class="ml-1 item-text">All tasks</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link pl-3" href="{{ url('/admintasks') }}"><span class="ml-1 item-text">Admin tasks</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link pl-3" href="{{ url('/hrmtasks') }}"><span class="ml-1 item-text">HRM tasks</span></a>
                  </li>
              </li>
            </ul>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('/reports') }}">
                  <i class="fe fe-book fe-16"></i>
                  <span class="ml-3 item-text">Reports</span>
                </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>User Management</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Users</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="contact">
                <a class="nav-link pl-3" href="{{ url('users') }}"><span class="ml-1">Users</span></a>
                {{-- <a class="nav-link pl-3" href="./contacts-new.html"><span class="ml-1">New User</span></a> --}}
              </ul>
            </li> 
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
        </nav>
      </aside>
    </div> <!-- .wrapper -->
  </body>
</html>
