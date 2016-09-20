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
					
                    <li><a href="{{ route('users.index') }}">Users</a></li>
                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li><a href="{{ route('itemCRUD2.index') }}">Items</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                            	<li><a href="{{ url('/portal/dashboard') }}"><span class="glyphicon glyphicon-th"></span>Dashboard</a></li>
                            	<li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
			</div>
		</div>
	</div><!-- mainmenu -->

	<div class="container logo-container">
	    <a href="/"><img src="/images/logo.png"></a><br />User Portal
	</div>

	<nav id="w1" class="navbar navbar-secondary" role="navigation">
	<!-- <div class="container">
	    <ul id="w2" class="navbar-nav navbar-left nav">
	    	<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Wedding Ideas <b class="caret"></b></a><ul id="w3" class="dropdown-menu"><li><a href="#" tabindex="-1">Action</a></li>
			<li><a href="#" tabindex="-1">Another action</a></li>
			<li><a href="#" tabindex="-1">Something else here</a></li></ul></li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Wedding Planning <b class="caret"></b></a><ul id="w4" class="dropdown-menu"><li><a href="#" tabindex="-1">Action</a></li>
			<li><a href="#" tabindex="-1">Another action</a></li>
			<li><a href="#" tabindex="-1">Something else here</a></li></ul></li>
			<li><a href="/my-big-day">My Big Day</a></li>
		</ul>
	</div> -->
	</nav>
</header>