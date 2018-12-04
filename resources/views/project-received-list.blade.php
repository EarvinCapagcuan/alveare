@extends('layouts/app')

@section('title', 'Received Projects')

@section('content')
<h3>Received Projects <span class="uk-badge"></span></h3>
	@foreach($projectSubmits as $project)
		@if(($project->project->instructor_id) == Auth::User()->id)
		<div class="card">
			<div class="card-header">
				{{ $project->project->project_name }}
			</div>
			<div class="card-body">
				<div>
					<span>Deadline: <em>{{ $project->project->deadline }}</em></span>
				</div>
				<div>
					<span>Requirements: {{ $project->project->project_req }}</span>
				</div>
				<div>
					<span>Status: {{ $project->project->status->status }}</span><br>
					<span>Submitted {{ $project->created_at->diffForHumans() }}</span>
				</div>
				<div>
					<span>Submitted by: {{ App\User::find($project->user_id)->full_name }}</span>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn" onClick="approveReceived({{ $project->id }})">Approve</button>
			</div>
		</div>
		@endif
	@endforeach
<script type="text/javascript">
	function approveReceived(id){
		console.log(id);
		$.ajax({
			url : '/approve-project-'+id,
			type : 'PATCH',
			data : {
				_method : 'PATCH',
				_token : '{{ csrf_token() }}'
			},
			success : function(data){
				if(data == 'success'){
					window.location.reload();
					UIkit.notification({
						message: 'Works like a charm.',
						status: 'success'})
					;
				}else{
						window.location.reload();
					UIkit.notification({
						message: 'Seems that there is an error.',
						status: 'danger'});
				}
			},
			error : function (jxhr){
				console.log(jxhr);
			}
		});
	}
</script>
@endsection