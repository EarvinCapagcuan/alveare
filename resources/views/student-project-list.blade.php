@extends('layouts/app')

@section('title', 'Project List')

@section('content')
<h3>Ongoing Projects <span class="uk-badge">{{ $count }}</span></h3>
<div class="row">
	@foreach($projects as $project)
	<div class="col-lg-3 m-auto">
		<div class="card">
			<div class="card-title">{{ $project->project_name }}</div>
			<div class="card-body">
				<div>Requirements: {{ $project->project_req }}</div>
				<div>Deadline: {{ $project->deadline }}</div>
				<div>{{ $project->status->status }}</div>
			</div>
			<div class="card-footer m-auto">
				@if(count($project->student))
				<a href="/student-{{ Auth::User()->id }}/submit-project-{{ $project->id }}" class="uk-disabled uk-button-muted"><i uk-icon="icon:check"></i>&nbsp;Submitted</a>
				@else
				<a href="/student-{{ Auth::User()->id }}/submit-project-{{ $project->id }}" class="uk-button"><i uk-icon="icon:check"></i>&nbsp;Submit</a>
				@endif
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection