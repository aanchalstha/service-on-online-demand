
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>S.O.O.D. Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard') }}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/')}}">
                <div class="sidebar-brand-text mx-3">Service on Online Demand</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ 'admin/home'== request()->path() ? 'active' :'' }}">
                <a class="nav-link" href="{{ route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">

           <!-- Heading -->
             <div class="sidebar-heading">
                Services Actions
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item {{ 'admin/service'== request()->path() ? 'active' :'' }}">
                <a class="nav-link" href="{{ url('admin/service') }}">
                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                    <span>Services Entry </span></a>
            </li>


            <li class="nav-item ">
                <a class="nav-link" href="">
                    <i class="fa fa-street-view" aria-hidden="true"></i>
                    <span> Service Providers </span></a>
            </li>

            <li class="nav-item {{ 'admin/service/categories'== request()->path() ? 'active' :'' }}">
                <a class="nav-link" href="{{ url('admin/service/categories')}}">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Service Categories </span></a>
            </li>
            <li class="nav-item {{ 'admin/service/categories'== request()->path() ? 'active' :'' }}">
                <a class="nav-link" href="{{ url('admin/service/categories')}}">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Sub-Categories </span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Site Management
            </div>
            <!-- Nav Item - Charts -->

            <li class="nav-item {{ 'admin/banner'== request()->path() ? 'active' :'' }}">
                <a class="nav-link" href="{{ url('admin/banner')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Banner Images</span></a>
            </li>

            <li class="nav-item {{ 'admin/testimonials'== request()->path() ? 'active' :'' }}">
                <a class="nav-link" href="{{ url('admin/testimonials')}}">
                    <i class="fa fa-quote-right" aria-hidden="true"></i>
                    <span>Testimonials</span></a>
            </li>
            <li class="nav-item {{ 'admin/blog'== request()->path() ? 'active' :'' }}">
                <a class="nav-link" href="{{ url('admin/blog')}}">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>News and Events</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">
                Account Settings
             </div>

            <li class="nav-item {{ 'admin/rights-register'== request()->path() ? 'active' :'' }} {{ 'admin/role-register'== request()->path() ? 'active' :'' }} {{ 'admin/users'== request()->path() ? 'active' :'' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Users Management</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
                        <a class="collapse-item" href="{{url('admin/rights-register')}}">Permissions</a>
                        <a class="collapse-item" href="{{ url('admin/role-register')}}">User Roles</a>
                        <a class="collapse-item" href="{{url('admin/users')}}">Users Listing</a>

                    </div>
                </div>
            </li>
            <li class="nav-item {{ 'admin/settings'== request()->path() ? 'active' :'' }}">
                <a class="nav-link" href="{{ url('admin/settings')}}">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    <span>Settings</span></a>
            </li>




            <!-- Divider -->


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                                                {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                        <!-- Nav Item - User Information -->

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;  Hello ! {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="content">

                    @yield('content')

                  </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dashboard') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('dashboard') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('dashboard') }}/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('dashboard') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('dashboard') }}/js/demo/chart-pie-demo.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

   <script>
        $("document").ready(function(){
        setTimeout(function(){
            $("div.alert").remove();
        }, 5000 ); // 5 secs

        $('.select2').select2();
    });

    </script>
    @yield('scripts')
</body>

</html>
        </main>
    </div>
</body>
</html>

