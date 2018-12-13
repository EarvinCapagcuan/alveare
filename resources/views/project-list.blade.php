@extends('layouts/app')

@section('title', 'Project List')

@section('content')
@if(Auth::User()->level_id == 2)
	<div class="row">
		<div class="col uk-flex uk-flex-between">
			<h3>Projects <span class="uk-badge">{{ $count }}</span></h3>
			<div><a href="#create-project-modal" class="uk-button uk-button-text" uk-toggle>Add Project</a></div>
		</div>
	</div>
@endif
<div>
	<span>Show by status</span>
	<select class="uk-select" name="byStatus" id="byStatus" onChange="byStatus()">
			<option value="All" selected>All</option>
		@foreach(App\ProjectStatus::whereIn('id', [1, 2])->get() as $status)
			<option value="{{ $status->status }}" {{ Session::Has("$status->status") ? "selected" : "" }}>{{ $status->status }}</option>
		@endforeach
	</select>
</div>
@if(count($projects)<1)
	<div class="m-3">
		<h4>No data.</h4>
	</div>
@else
	@foreach($projects as $project)
		<div class="m-3" uk-grid>
			<div class="uk-width-expand" id="project-list">
				Project Title: <span>{{ ucfirst($project->project_name) }}</span><br>
				Requirements: <span>{{ ucfirst($project->project_req) }}</span><br>
				Deadline: <span>{{ $project->deadline }}</span><br>
				Status: <span>{{ $project->status->status }}</span>
				@if(Auth::User()->level_id == 3)
				<br>Instructor: <span>{{ ucwords($project->instructor->full_name) }}</span>
				@endif
			</div>
			@if($project->status->id == 1 && Auth::User()->level_id == 2)
				<a href="#project-modal-{{ $project->id }}" class="uk-button edit-project" uk-toggle uk-tooltip="title:Edit project"><span uk-icon="icon: file-edit"></span></a>
				<a href="#project-close-{{ $project->id }}" class="uk-button" uk-toggle uk-tooltip="title:Close project"><span uk-icon="icon: clock"></span></a>
			@endif
		</div>
		@if(Auth::User()->level_id == 2)
		<!-- modal for editing -->
		<div class="uk-modal-full" id="project-modal-{{ $project->id }}" uk-modal>
			<div class="uk-modal-dialog">
				<button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
				<div class="uk-grid-collapse uk-flex-middle" uk-grid>
					<div class="uk-background-cover uk-width-1-4@md uk-width-1-4@s" style="background-color: gray;" uk-height-viewport>

					</div>
					<div class="uk-width-3-4@md uk-width-3-4@s uk-padding-large">
						<h3 class="uk-text-center">Edit {{ $project->project_name }}</h3>
						<form class="uk-form-stacked">
							<label class="uk-form-label" for="title">Project Title</label>
							<div class="uk-form-controls
							">
							<input type="text" class="uk-input" name="title" id="title-{{ $project->id }}" value="{{ $project->project_name }}"></input>
						</div>
						<div class="uk-child-width-1-2" uk-grid>
							<div class="uk-width-1-2">
								<label class="uk-form-label" for="batch">Batch</label>
								<div class="uk-form-controls
								">
								<select name="batch" id="batch-{{ $project->id }}" class="uk-select uk-disabled" disabled>
									@foreach(App\Batch::all() as $batch)
									<option value="{{ $batch->id }}" {{ $batch->id == $project->batch_id ? 'selected' : ''  }}>{{ $batch->batch_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="uk-width-1-2">
							<label class="uk-form-label" for="deadline">Deadline</label>
							<div class="uk-form-controls
							">
							<input type="text" class="uk-input date" name="deadline" id="deadline-{{ $project->id }}" value="{{ $project->deadline }}"></input>
						</div>
					</div>
				</div>
				<label class="uk-form-label" for="req">Project Requirements</label>
				<div class="uk-form-controls
				">
				<textarea class="uk-textarea" id="req-{{ $project->id }}"" name="req">{{ $project->project_req }}</textarea>
			</div>
			<div class="uk-button-group my-3">
				<button class="uk-button uk-button-secondary" id="edit-project" type="submit" onClick="edit({{ $project->id }})">Save Changes</button>
				<button class="uk-modal-close uk-button" type="button" >Cancel</button>
			</div>
		</form>
		</div>
		</div>
		</div>
		</div>

		<!-- modal for closing the project -->
		<div class="uk-modal" id="project-close-{{$project->id}}" uk-modal>
			<div class="uk-modal-dialog">
				<button class="uk-modal-close-default" type="button" uk-close></button>
				<div class="uk-modal-header">
					<h3 class="uk-modal-title">Close {{ $project->project_name }}?</h3>
				</div>
				<div class="uk-modal-body" uk-overflow-auto>
					<div uk-grid>
						<div>
							<span></span>
						</div>
						<div class=" m-auto">
							<table border class="uk-table">
								<thead>
									<tr>
										<th colspan="4">Project Information:</th>
									</tr>
									<tr>
										<th>Project name</th>
										<th>Batch</th>
										<th>Deadline</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{ $project->project_name }}</td>
										<td>{{ $project->batch->batch_name }}</td>
										<td>{{ $project->deadline }}</td>
										<td>{{ $project->status->status }}</td>
									</tr>
									<tr>
										<td colspan="4" align="right"><em>Created: {{ $project->created_at->diffForHumans() }}</em></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="uk-modal-footer">
					<span>Are you sure you want to close this project?</span>
					<div class="uk-button-group">
						<button class="uk-button" id="confirm-delete" type="submit" onClick="confirmClose({{ $project->id }})">Yes</button>
						<button class="uk-button uk-modal-close">No</button>
					</div>
				</div>
			</div>
		</div>
		@endif
	@endforeach
@endif
<ul class="uk-pagination uk-flex-center m-2">
	{{ $projects->links() }}
</ul>
@if(Auth::User()->level_id == 2)
{{-- modal for creating projects --}}
<div id="create-project-modal" class="uk-flex-top" uk-modal>
	<div class="uk-modal-dialog uk-margin-auto-vertical">
		<div class="uk-modal-header">
			<div class="uk-modal-title">Add Project</div>
		</div>
		<div class="uk-modal-body">
			<form class="uk-form-stacked">
				<label class="uk-form-label" for="projectName">Project title</label>
				<div class="uk-form-controls">
					<input type="text" name="projectName" id="projectName" class="uk-input">
				</div>
				<label class="uk-form-label" for="projectRequirements">Project requirements</label>
				<div class="uk-form-controls">
					<textarea name="projectRequirements" id="projectRequirements" class="uk-textarea"></textarea>
				</div>
				<label class="uk-form-label" for="projectBatch">Batch</label>
				<div class="uk-form-controls">
					<input type="text" name="projectBatch" id="projectBatch" class="uk-disabled uk-input" value="{{ Auth::User()->batch->batch_name }}" disabled>
				</div>
				<label class="uk-form-label" for="projectDeadline">Deadline</label>
				<div class="uk-form-controls">
					<input type="text" name="projectDeadline" id="projectDeadline" class="date uk-date">
				</div>
			</form>
		</div>
		<div class="uk-modal-footer">
			<button class="uk-button" onClick="createProject()">Add project</button>
			<button class="uk-button uk-modal-close">Cancel</button>
		</div>
		
	</div>
</div>
@endif

<!-- js to save project edits -->
<script type="text/javascript">
	function edit(id){
		let title = $('#title-'+id).val();
		let batch = $('#batch-'+id).val();
		let deadline = $('#deadline-'+id).val();
		let req = $('#req-'+id).val();

		$.ajax({
			url : '/admin/edit-project/'+id,
			type : 'PATCH',
			data : {
				project_name : title,
				batch_id : batch,
				deadline : deadline,
				project_req : req,
				_method : 'PATCH',
				_token : '{{ csrf_token() }}'
			},
			success : function(data){
				if(data){
					window.location.reload();
				sessionStorage.reloadAfterPageLoad = true;
				}
			},
			error : function(data){
				$.each(data.responseJSON.errors, function(key,value){
					UIkit.notification({message : value, status : 'danger'});
				});
			}
		});
	}

	function confirmClose(id){
		$.ajax({
			url : '/admin/close-project/'+id,
			type : 'PATCH',
			data : {
				id : id,
				_method : 'PATCH',
				_token : '{{ csrf_token() }}'
			},
			success : function(data){
				if(data){
					window.location.reload();
				sessionStorage.reloadAfterPageLoad = true;
				}
			},
			error : function(data){
				$.each(data.responseJSON.errors, function(key,value){
					UIkit.notification({message : value, status : 'danger'});
				});
			}
		});
	}

	function byStatus(){
		let status = $('#byStatus').val();
		$.ajax({
			url : '/admin/'+status+'/{{ Auth::User()->level_id }}-{{ Auth::User()->id }}/projects',
			type : 'GET',
			data : {
				_method : 'GET',
				_token : '{{ csrf_token() }}'
			},
			success : function(data){
				window.location.replace('/admin/'+status+'/{{ Auth::User()->level_id }}-{{ Auth::User()->id }}/projects');
			}
		});
	}

	function createProject(){
		let projectName = $('#projectName').val();
		let projectDeadline = $('#projectDeadline').val();
		let projectRequirements = $('#projectRequirements').val();

		$.ajax({
			url : '/admin/create-project',
			type : 'POST',
			data : {
				title : projectName,
				deadline : projectDeadline,
				requirements : projectRequirements,
				_method : 'POST',
				_token : '{{ csrf_token() }}'
			},
			success : function(data){
				if(data){
					window.location.reload();
				sessionStorage.reloadAfterPageLoad = true;
				}
			},
			error : function(data){
				$.each(data.responseJSON.errors, function(key,value){
					UIkit.notification({message : value, status : 'danger'});
				});
			}
		});
	}
	$( function () {
		if ( sessionStorage.reloadAfterPageLoad ) {
			UIkit.notification({message : 'Success.', status : 'success'});
			sessionStorage.clear();
		}
	});
</script>
@endsection