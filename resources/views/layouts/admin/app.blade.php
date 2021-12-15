<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('pageTitle')</title>

    <link rel="icon" href="{{ asset('admin/dist/img/AdminLTELogo.png') }}" type="image/x-icon" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
        href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">

    @yield('css')
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a class="brand-link">
                <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SDN CIMUNING 1</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu"
                        data-accordion="false">
                        
                        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('teacher'))
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ setMenu($menu, 'home') }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Beranda
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('register.index') }}" class="nav-link {{ setMenu($menu, 'register') }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Pendaftaran Siswa Baru
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">MASTER DATA</li>
                        @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item {{ openMenu($menu, 'users') }}">
                            <a class="nav-link {{ setMenu($menu, 'users') }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Pengguna
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.index', 'admin') }}" class="nav-link {{ isset($submenu) ? setMenu($submenu, 'admin') : null }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admin</p>
                                        <span class="badge badge-info right">{{ App\Models\Role::where('name', 'admin')->first()->users()->count() }}</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.index', 'teacher') }}" class="nav-link {{ isset($submenu) ? setMenu($submenu, 'teacher') : null }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Guru</p>
                                        <span class="badge badge-info right">{{ App\Models\Role::where('name', 'teacher')->first()->users()->count() }}</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.index', 'student') }}" class="nav-link {{ isset($submenu) ? setMenu($submenu, 'student') : null }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Murid</p>
                                        <span class="badge badge-info right">{{ App\Models\Role::where('name', 'student')->first()->users()->count() }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('teachers.index') }}" class="nav-link {{ setMenu($menu, 'teacher') }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Guru
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link {{ setMenu($menu, 'student') }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Murid
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ openMenu($menu, 'levels') }}">
                            <a class="nav-link {{ setMenu($menu, 'levels') }}">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Tingkatan Sekolah
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            @if(Auth::user()->hasRole('admin'))
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('levels.index') }}" class="nav-link {{ isset($submenu) ? setMenu($submenu, 'level') : null }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tingkatan Sekolah</p>
                                    </a>
                                </li>
                            </ul>
                            @endif
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('classes.index') }}" class="nav-link {{ isset($submenu) ? setMenu($submenu, 'class') : null }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('classes.mapping') }}" class="nav-link {{ setMenu($menu, 'class_mapping') }}">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p>
                                    Pemetaan Kelas
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('subjects.index') }}" class="nav-link {{ setMenu($menu, 'subject') }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Mata Pelajaran
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('schedules.index') }}" class="nav-link {{ setMenu($menu, 'schedule') }}">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>
                                    Jadwal
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('student_values') }}" class="nav-link {{ setMenu($menu, 'student_values') }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Nilai Siswa
                                </p>
                            </a>
                        </li>
                        @else 
                        <li class="nav-item">
                            <a href="{{ route('s_values') }}" class="nav-link {{ setMenu($menu, 's_values') }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Nilai Saya
                                </p>
                            </a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a data-redirect="{{ route('login') }}" data-url="{{ route('logout') }}" class="nav-link btn-logout">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="https://">{{ SCHOOL_NAME }}</a>.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @yield('modal')

    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>

    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script src="{{ asset('js/ajaxLoad.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>

    <script type="text/javascript">
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    @yield('scripts')

</body>

</html>