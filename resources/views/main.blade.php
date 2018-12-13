@extends('layouts/app')

@section('title', 'Main')

@section('content')
<div class="row">
	<div class="col">
		<h3>Main</h3>
	</div>
</div>
<div class="row p-3">
	<div class="col uk-child-width-1-4@m m-auto p-0 uk-flex uk-flex-between@m" uk-grid>
		<div class="uk-card uk-card-body uk-card-default uk-card-small text-center">
			<i class="far fa-user fa-7x"></i>
			<div class="uk-card-header">
				@if(Auth::User()->level_id == 3)
				<a href="/admin/users/3" class="uk-button uk-button-text uk-card-title">Accounts</a>&nbsp;
				@elseif(Auth::User()->level_id == 2)
				<a href="/admin/users/2" class="uk-button uk-button-text uk-card-title">Students</a>&nbsp;
				@else
				<a href="/profile" class="uk-button uk-button-text uk-card-title">{{ ucwords(Auth::User()->firstname) }}</a>
				@endif
			</div>
		</div>
		<div class="uk-card uk-width-1-3@m uk-card-body uk-card-default uk-card-small text-center">
			<i class="far fa-newspaper fa-7x"></i>
			<div class="uk-card-header">
				<a href="/{{ Auth::User()->id }}/announcements" class="uk-button uk-button-text uk-card-title">Announcements</a>
			</div>
		</div>
		<div class="uk-card uk-card-body uk-card-default uk-card-small text-center">
			<i class="far fa-calendar-check fa-7x"></i>
			<div class="uk-card-header">
				@if(Auth::User()->level_id == 3 || Auth::User()->level_id == 2)
				<a href="/admin/All/{{Auth::User()->level_id}}-{{Auth::User()->id}}/projects" class="uk-button uk-button-text uk-card-title">Projects</a>
				@else
				<a href="/batch-{{ Auth::User()->batch_id }}/projects-list" class="uk-button uk-button-text uk-card-title">Projects</span></a>
				@endif
			</div>
		</div>
	</div>
</div>
<div class="row p-3 uk-flex-between">
	@if(Auth::User()->level_id != 1)
	<div class="col-4 uk-width-1-4 p-0">
		<div class="uk-card uk-card-small uk-card-default">
			<div class="uk-card-header">
				<h3 class="uk-card-title"><i uk-icon="icon:history"></i>&nbsp;Recently added</h3>
			</div>
			<div class="uk-card-body">
				@if(count($users)<1)
				<div><strong>No data yet.</strong></div>
				@else
				@foreach( $users as $key => $user )
					@if( $key == 3)
					@break
					@endif
				<article class="uk-overflow-hidden uk-article m-auto py-1 border-bottom">
					<h4>{{ $user->full_name }}</h4>
					<div class="uk-article-meta">
						Added {{ $user->created_at->diffForHumans() }}
					</div>
					<span>
						<a href="/{{ $user->level->name }}-{{ $user->id }}" class="uk-button uk-button-text">Check {{ $user->level->name }} account</a>
					</span>
				</article>
				@endforeach
				@endif
			</div>
		</div>
	</div>
	@endif
	<div class="col-7 uk-width-2-3 p-0 m-auto">
		<div class="row">
			<div class="col mb-4">
				<div class="uk-card uk-card-small uk-card-default">
					<div class="uk-card-header">
						<h3 class="uk-card-title"><i uk-icon="icon:info"></i>&nbsp;Recent announcements</h3>
					</div>
					<div class="uk-card-body">
						@if(count($notices)<1)
						<div><strong>No data yet.</strong></div>
						@else
						@foreach($notices as $key => $notice)
							@if($key == 2)
								@break
							@endif
						<article class="uk-comment">
							<header class="uk-comment-header">
								<h4 class="uk-comment-title">{{ $notice->title }}</h4>
							</header>
							<div class="uk-comment-body">
								{{ $notice->content }}
							</div>
							<small><em>Posted by: {{ $notice->instructor->full_name }},&nbsp;{{ $notice->created_at->diffForHumans() }}</em></small>
						</article>
						@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="uk-card uk-card-small uk-card-default">
					<div class="uk-card-header">
						<h3 class="uk-card-title"><i class="far fa-calendar-alt"></i>&nbsp;Recent Projects</h3>
					</div>
					<div class="uk-card-body">
						@if(count($notices)<1)
						<div><strong>No data yet.</strong></div>
						@else
						@foreach($projects as $key => $project)
						@if($key == 2)
						@break
						@endif
						<article class="uk-comment">
							<header class="uk-comment-header">
								<h3 class="uk-comment-title"><small>Project title: </small>{{ $project->project_name }}</h3>
							</header>
							<div class="uk-comment-body uk-flex uk-flex-between">
								<span><strong>Project requirements: </strong>{{ $project->project_req }}</span>
								<span><em>Deadline: </em>{{ $project->deadline }}</span>
							</div>
							<hr>
						</article>
						@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection