<nav class="navbar navbar-expand-lg p-4" style="background-color: #2D736F; ">
	<a href="/" class="navbar-brand alveare-brand">alveare</a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav">
		<span class="navbar-toggler-icon"></span>
	</button>
<div id="nav" class="collapse navbar-collapse alveare-default" >
	<ul class="navbar-nav ml-auto" style="">
		@auth
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
        @endauth
        </ul>
    </div>
</nav>