<div class="sidenav px-2 m-auto">
	<div class="text-center accordion" id="nav-accordion">
		@guest
		<div class="card">
			<div class="card-header" id="heading-option-1">
				<h5>
					<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#option-1">Account</button>
				</h5>
			</div>
		</div>
		<div>
			<div id="option-1" class="collapse" data-parent="#nav-accordion">
				<div class="card-body">
					<ul class="nav flex-column">
						<li class="nav-item"><a href="{{ route('login') }}" class="nav-link">login</a></li>
						<li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
					</ul>
				</div>
			</div>
		</div>
		@else
		<div>
			<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#option-2">Accounts</button>
		</div>
		<div>
			<div id="option-2" class="collapse" data-parent="#nav-accordion">
					<ul class="nav flex-column">
						@if(Auth::user()->level_id==3)
						<li class="nav-item"><a href="/manager" class="nav-link">Profile</a></li>
						@elseif(Auth::user()->level_id==2)
						<li class="nav-item"><a href="/instructor" class="nav-link">Profile</a></li>
						@elseif(Auth::user()->level_id==1)
						<li class="nav-item"><a href="/student" class="nav-link">Profile</a></li>					
						@endif
						<li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
					</ul>
			</div>
		</div>
		@endguest
	</div>
</div>