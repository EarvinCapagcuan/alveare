@extends('layouts/app')

@section('title', 'Project List')

@section('content')
<div class="row">
	<div class="col">
		<h3>Ongoing Projects</h3>
	</div>
</div>
<div class="row">
	@if (count($projects)<1)
		<div class="col">
			<h4>No data.</h4>
		</div>
	@else
	@foreach($projects as $project)
	@php
		$x = json_decode($project->user, true);
	@endphp
	<div class="col-8 m-auto py-3">
		<div class="card">
			<div class="card-header">{{ ucwords($project->project_name) }}</div>
			<div class="card-body">
				<p>Requirements: {{ ucfirst($project->project_req) }}</p>
				<div class="uk-flex uk-flex-between">
					<span><em>Deadline: {{ $project->deadline }}</em></span>
					<span><strong>{{ $project->status->status }}</strong></span>
				</div>
			</div>
			<div class="card-footer text-center">
				@if($x != null)
				<a href="#" class="uk-disabled uk-button-muted text-success"><i uk-icon="icon:check"></i>&nbsp;Submitted</a>
				@else
					@if($project->status_id != 2)
					<a href="/student-{{ Auth::User()->id }}/submit-project-{{ $project->id }}" class="uk-button text-primary"><i uk-icon="icon:check"></i>&nbsp;Submit</a>
					@else
					<span class="text-danger"><i uk-icon="icon:close"></i>Project closed</span>
					@endif
				
				@endif
			</div>
		</div>
	</div>
	@endforeach
	@endif
</div>
	<div class="row">
		<span class="uk-text-center m-auto">
			{{ $projects->links() }}
		</span>
	</div>

@endsection