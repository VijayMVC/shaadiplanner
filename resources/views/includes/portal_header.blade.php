<header>
	<div class="navbar navbar-default" role="navigation"><!-- navbar-fixed-top -->
		<div class="container">
			<div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	        </div>
	        <div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="/about">About</a></li>
					<li><a href="/contact">Contact</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                            	<li><a href="{{ URL::route('portal.dashboard') }}"><span class="glyphicon glyphicon-th"></span>Dashboard</a></li>
                                <li><a href="{{ URL::route('portal.edit_profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
                            	<li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
			</div>
		</div>
	</div><!-- mainmenu -->

	<div class="container logo-container">
	    <a href="{{ URL::route('portal.dashboard') }}"><img src="{{URL::asset('images/logo.png') }}"></a>
	</div>
</header>