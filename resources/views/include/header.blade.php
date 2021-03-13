<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>

  </head>

  <div class="fh5co-loader"></div>
  <div id="page">

    <nav class="fh5co-nav" role="navigation">
		<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-right">
						<p class="site">www.nienepal.com</p>
                        <p class="num">Call: +977-9851279796 | +977-9851279795 </p>
                        @guest
                     <p class="num"> <a href="{{ route('login')}}"><span>Login</span></a></p>
                    <p class="num"> <a href="{{ route('register')}}"><span>Register</span></a></p>
                        @else
                    <p class="num"> <a href="{{ route('home')}}"><span>Dashboard</span></a></p>

                        @endguest
						<ul class="fh5co-social">
							<li><a href="https://www.facebook.com/nepalinstituteofengineering"><i class="icon-facebook2"></i></a></li>
							<li><a href="https://www.youtube.com/channel/UCwAm2rbj6QhkaGBteE9Gm2Q?sub_confirmation=1"><i class="icon-youtube"></i></a></li>
							<li><a href="https://www.youtube.com/channel/UCwAm2rbj6QhkaGBteE9Gm2Q?sub_confirmation=1"><i class="icon-instagram"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/nepal-institute-of-engineering-nie-9621111bb/"><i class="fab fa-linkedin-in"></i> </a></li>

                        </ul>
					</div>
				</div>
			</div>
		</div>
		<div class="top-menu">
			<div class="container">
				<div class="row">
                    <a href="{{ url('/')}}" style="padding-left:5rem;"><img  src="{{URL::to('assets')}}/images/nielogo.png" height="200" width="200"></a>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="{{ '/'== request()->path() ? 'active' :'' }}"><a href="{{ URL::to('/') }}">Home</a></li>
							<li class="{{ 'all-courses'== request()->path() ? 'active' :'' }}"><a href="{{ url('/all-courses')}}">Courses</a></li>
                            <li class="{{ 'consulting'== request()->path() ? 'active' :'' }}"><a href="{{ url('/consulting')}}">Consulting Services</a></li>
							{{-- <li {{ '/teacher'== request()->path() ? 'active' :'' }}><a href="{{ url('/teacher')}}">Teachers</a></li> --}}
							<li class="{{ 'about'== request()->path() ? 'active' :'' }}"><a href="{{ url('/about')}}">About Us</a></li>
							<li class="{{ 'blog'== request()->path() ? 'active' :'' }}"><a href="{{ url('/blog')}}">Blogs</a></li>
							<li class="{{ 'contact'== request()->path() ? 'active' :'' }}"><a href="{{route('contact')}}">Contact</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
    </nav>
  </div>
@include('include.css')

