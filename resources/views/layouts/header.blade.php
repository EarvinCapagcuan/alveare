<nav class="navbar navbar-expand-lg p-5" style="background-color: #2D736F; ">
	<a href="/" class="navbar-brand" style="Font-Family: 'Julius Sans One', Sans-Serif; Font-Size: 45px; color: #F2E4C1;">alveare</a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div id="nav" class="collapse navbar-collapse" style="Font-Family: 'Julius Sans One', Sans-Serif; color: #F2E4C1;">
		<ul class="navbar-nav ml-auto" style="">
			@guest
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link" style="color: #F2E4C1;">Login</a></li>
            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link" style="color: #F2E4C1;">Register</a></li>
            @else
            <li class="nav-item">
                <a href="/{{ Auth::user()->name }}" class="nav-link">Welcome, {{ Auth::user()->firstname }}</a>
            </li>
			<li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
            </li>
            @endguest
        </ul>
    </div>
</nav>