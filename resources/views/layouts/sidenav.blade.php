<div class="row p-0 m-0">
	<nav id="sidebar-nav">
		@auth
		@if(Auth::user()->level_id==3)
		<ul class="uk-nav-default" uk-nav>
			<li class="uk-active"><h4 class="text-center"><i uk-icon="icon:cog"></i>&nbsp;Dashboard</h4></li>
			<li class="uk-parent">
				<a href="#"><i uk-icon="icon:home"></i>&nbsp;Home</a>
					<ul class="uk-nav-sub">
					<li><a href="/main">Main</a></li>
					<li><a href="/manager">Profile</a></li>	
				</ul>
			</li>
			<li class="uk-parent">
				<a href="#"><i uk-icon="icon:users"></i>&nbsp;Manage Accounts</a>
				<ul class="uk-nav-sub">
					<li><a href="/admin/instructor-list">Instructors List</a></li>
					<li><a href="/admin/student-list">Students List</a></li>
					<li><a href="{{ route('register') }}">Add User</a></li>
				</ul>
			</li>
			<li class="uk-parent">
				<a href="#"><i uk-icon="icon:calendar"></i>&nbsp;Check Works</a>
				<ul class="uk-nav-sub">
					<li><a href="/admin/All/{{Auth::User()->id}}-{{Auth::User()->level_id}}/projects">Projects</a></li>
					<li><a href="/admin/All/{{Auth::User()->id}}-{{Auth::User()->level_id}}/announcements">Announcements</a></li>	
				</ul>
			</li>
		</ul>
		@elseif(Auth::user()->level_id==2)
		@elseif(Auth::user()->level_id==1)
		@endif
	@endguest
	</nav>
</div>