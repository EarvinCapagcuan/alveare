<div class="row p-0 m-0" uk-sticky="media: 640">
	<nav id="sidebar-nav">
		@auth
		<ul class="uk-nav-default" uk-nav>
			<li class="uk-active"><h4 class="text-center"><i uk-icon="icon:cog"></i>&nbsp;Dashboard</h4></li>
			<li class="uk-parent">
				<a href="#"><i uk-icon="icon:home"></i>&nbsp;Home</a>
					<ul class="uk-nav-sub">
					<li><a href="/main">Main</a></li>
					<li><a href="/profile">Profile</a></li>	
				</ul>
			</li>
		@if(Auth::user()->level_id==3)
			<li class="uk-parent">
				<a href="#"><i uk-icon="icon:users"></i>&nbsp;Manage Accounts</a>
				<ul class="uk-nav-sub">
					<li><a href="/admin/users/3">Account List</a></li>
					<li><a href="/admin/batch-list">Batches</a></li>
					<li><a href="{{ route('register') }}">Add User</a></li>
				</ul>
			</li>
			<li class="uk-parent">
				<a href="#"><i uk-icon="icon:calendar"></i>&nbsp;Check Works</a>
				<ul class="uk-nav-sub">
					<li><a href="/admin/All/{{Auth::User()->level_id}}-{{Auth::User()->id}}/projects">Projects</a></li>
					<li><a href="/{{Auth::User()->id}}/announcements">Announcements</a></li>
				</ul>
			</li>
		</ul>
		@elseif(Auth::user()->level_id==2)
			<li class="uk-parent">
				<a href="#"><i uk-icon="icon:users"></i>&nbsp;Manage Accounts</a>
				<ul class="uk-nav-sub">
					<li><a href="/admin/users/1">Students List</a></li>
				</ul>
			</li>
			<li class="uk-parent">
				<a href="#"><i uk-icon="icon:calendar"></i>&nbsp;Check Works</a>
				<ul class="uk-nav-sub">
					<li><a href="/admin/All/{{Auth::User()->level_id}}-{{Auth::User()->id}}/projects">Projects</a></li>
					<li><a href="/{{Auth::User()->id}}/announcements">Announcements</a></li>	
				</ul>
			</li>
		</ul>
		@elseif(Auth::user()->level_id==1)
		<ul class="uk-nav-default" uk-nav>
			<li><a href="/batch-{{ Auth::User()->batch_id}}/projects-list"><i uk-icon="icon:calendar"></i>&nbsp;Projects</a></li>
			<li><a href="/{{ Auth::User()->id }}/announcements"><i uk-icon="icon:info"></i>&nbsp;Announcements</a></li>
			</li>
		</ul>
		@endif
	@endguest
	</nav>
</div>