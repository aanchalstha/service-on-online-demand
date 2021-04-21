<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
 S.O.O.D. Customer Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->

  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 <!-- CSS Files -->
 <link href="{{ asset('customerdash') }}/assets/css/bootstrap.min.css" rel="stylesheet" />
 <link href="{{ asset('customerdash') }}/assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
 <!-- CSS Just for demo purpose, don't include it in your project -->
 <link href="{{ asset('customerdash') }}/assets/demo/demo.css" rel="stylesheet" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

</head>

<body class="">
    <div class="wrapper ">
      <div class="sidebar" data-color="green">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
      -->
        <div class="logo">

<center>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="text-decoration:none;" href="{{ url('/')}}">
        <div class="sidebar-brand-text mx-2"> <h5 style="color:snow; "> SERVICE ON ONLINE DEMAND </h5></div>
    </a>
                 {{-- <a href="{{ url('/')}}"> <h5 style="text-decoration: none; font-weight: bold;
                  color: snow;">SERVICE ON <br> ONLINE DEMAND</h5></a> --}}
</center>

        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <ul class="nav">
              <li class="{{ 'customer'== request()->path() ? 'active' :'' }}">
                <a href="{{url('customer')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="{{ 'customer/view/completed/services'== request()->path() ? 'active' :'' }}">
              <a href="{{ url('/customer/view/completed/services')}}">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>

                  <p>Completed Services</p>
                </a>
              </li>

              <li class="{{ 'customer/reviews'== request()->path() ? 'active' :'' }}">
                <a href="{{ url('/customer/reviews')}}">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                  <p>Reviews and Feedbacks &nbsp;</p>
                </a>
              </li>


{{--
              <li class="{{ 'customer/user-profile'== request()->path() ? 'active' :'' }}">
              <a href="{{url('/customer/')}}">
                <i class="fa fa-credit-card" aria-hidden="true"></i>

                  <p>Payment</p>
                </a>
              </li> --}}
              <li class="{{ 'customer/settings'== request()->path() ? 'active' :'' }}">
                <a href="{{ url('customer/settings')}}">
                      <i class="fa fa-cogs" aria-hidden="true"></i>
                    <p>Settings</p>
                  </a>
                </li>


            </ul>
          </div>
        </div>
        <div class="main-panel" id="main-panel">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
            <div class="container-fluid">
              <div class="navbar-wrapper">
                <div class="navbar-toggle">
                  <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                  </button>
                </div>
                {{-- <a class="navbar-brand" href=""></a> --}}
              </div>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <form method="POST" action="/customer/search/product">
                  @csrf
                  <div class="input-group no-border">
                    <input type="text" name = "search" value="" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </form>
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->fname }} <span class=""></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                               <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>

                  </ul>
              </div>
            </div>
          </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm">

        </div>
        <div class="content">
            @if(session()->has('message'))
            <div class="alert alert-success">{{session()->get('message')}}</div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}} </div>
            @endif

          <div class="container">
            @yield('content')
        </div>


        </div>


      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('customerdash') }}/assets/js/core/jquery.min.js"></script>
    <script src="{{ asset('customerdash') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('customerdash') }}/assets/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('customerdash') }}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="{{ asset('customerdash') }}/assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('customerdash') }}/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('customerdash') }}/assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('customerdash') }}/assets/demo/demo.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    @yield('scripts')
  </body>


  </html>
<script>
    $("document").ready(function(){
    setTimeout(function(){
        $("div.alert").remove();
    }, 5000 ); // 5 secs

});
</script>
