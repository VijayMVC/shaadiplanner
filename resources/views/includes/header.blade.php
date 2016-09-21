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
                    <li><a href="{{ URL::route('show_page',['page'=>'about']) }}">About</a></li>
					<li><a href="{{ URL::route('contact_page') }}">Contact</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ URL::to('login') }}">Login</a></li>
                        <li><a href="{{ URL::to('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @role('administrator')
                                	<li><a href="{{ URL::route('admin.dashboard') }}"><span class="glyphicon glyphicon-th"></span>Dashboard</a></li>
                                @endrole
                                @role('business')
                                	<li><a href="{{ URL::route('admin.dashboard') }}"><span class="glyphicon glyphicon-th"></span>Dashboard</a></li>
                                @endrole
                                @role('member')
                                	<li><a href="{{ URL::route('admin.dashboard') }}"><span class="glyphicon glyphicon-th"></span>Favourites</a></li>
                                @endrole
                           	    <li><a href="{{ URL::to('/logout') }}"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
			</div>
		</div>
	</div><!-- mainmenu -->

	<div class="container logo-container">
	    <a href="{{ URL::route('frontpage') }}"><img src="{{URL::asset('images/logo.png') }}"></a>
	</div>

	<nav id="w1" class="navbar navbar-secondary" role="navigation">
	<div class="container">
	    <ul id="w2" class="navbar-nav navbar-left nav">
	    	<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Wedding Ideas <b class="caret"></b></a><ul id="w3" class="dropdown-menu"><li><a href="#" tabindex="-1">Action</a></li>
			<li><a href="#" tabindex="-1">Another action</a></li>
			<li><a href="#" tabindex="-1">Something else here</a></li></ul></li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Wedding Planning <b class="caret"></b></a><ul id="w4" class="dropdown-menu"><li><a href="#" tabindex="-1">Action</a></li>
			<li><a href="#" tabindex="-1">Another action</a></li>
			<li><a href="#" tabindex="-1">Something else here</a></li></ul></li>
			<li><a href="/my-big-day">My Big Day</a></li>
		</ul>
	</div>
	</nav>
</header>