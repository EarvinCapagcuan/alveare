@extends('layouts/app')

@section('title', 'Announcements')

@section('content')
	<div class="row">
		<div class="col">
			<h3>Announcements</h3>
		</div>
		@if(Auth::User()->level_id == 2)
		<div>
			<a href="#post-announcement" class="uk-button" uk-toggle>Post an announcement</a>
		</div>
		@endif
	</div>
	<div class="row">
		<div class="col">
		@foreach($notices as $notice)
			<div class="uk-card-default uk-card-small m-3">
				<div class="uk-card-header">
					<span class="uk-card-title">{{ $notice->title }}</span>
					@if(Auth::User()->id == $notice->instructor->id)
					<span><a href="#editProject-{{ $notice->id }}" uk-tooltip="title: Edit Notice" uk-toggle><i uk-icon="icon:file-edit"></i></a></span>
					@endif
				</div>
				<div class="uk-card-body">
					<p>{{ $notice->content }}</p>
					<div class="uk-flex uk-flex-between" uk-grid>
						<small>{{ $notice->instructor->full_name }}</small>
						<small><em>{{ $notice->created_at->diffForHumans() }}</em></small>
					</div>
				</div>
			</div>
			@if(Auth::User()->id == $notice->instructor->id)
			<!-- edit announcement modal -->
			<div id="editProject-{{ $notice->id }}" uk-modal>
				<div class="uk-modal-dialog">
				<button class="uk-modal-close-default" uk-close></button>
					<div class="uk-modal-header">
						<div class="uk-modal-title">
							Edit Announcement
						</div>
					</div>
					<div class="uk-modal-body">
						<form class="uk-form-stacked">
							<label class="uk-form-label" for="title">Title</label>
							<div class="uk-form-controls">
								<input type="text" name="title" id="title_{{ $notice->id }}" class="uk-input" value="{{ $notice->title }}">
							</div>
							<label class="uk-form-label" for="content">Content</label>
							<div class="uk-form-controls">
								<textarea class="uk-textarea" name="content" id="content_{{ $notice->id }}">{{ $notice->content }}</textarea>
							</div>
						</form>
					</div>
					<div class="uk-modal-footer text-right">
						<button class="uk-button" type="submit" onClick="editNotice({{ $notice->id }})">Save</button>
						<button class="uk-button uk-modal-close">Cancel</button>
					</div>
				</div>
			</div>
			@endif
		@endforeach
		</div>
	</div>

	@if(Auth::User()->id == $notice->instructor->id)
	<!-- post announcement modal -->
	<div id="post-announcement" uk-modal>
		<div class="uk-modal-dialog">
			<button class="uk-modal-close-default" uk-close></button>
			<div class="uk-modal-header">
				<h3>Post a Notice</h3>
			</div>
			<div class="uk-modal-body">
				<label class="uk-form-label">Title</label>
				<div class="uk-form-control">
					<input type="text" name="post-title" id="post-title" class="uk-input">
				</div>
				<label class="uk-form-label">Content</label>
				<div class="uk-form-control">
					<textarea class="uk-textarea" name="post-content" id="post-content"></textarea>
				</div>
			</div>
			<div class="uk-modal-footer">
				<div class="uk-button-group">
					<button class="uk-button uk-button-primary" onClick="postNotice({{ Auth::User()->id }})">Save</button>
					<button class="uk-button uk-modal-close">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	@endif
<script type="text/javascript">
	function postNotice(id){
		let postTitle = $('#post-title').val();
		let postContent = $('#post-content').val();

		$.ajax({
			url : '/admin/'+id+'/create-post',
			type : 'POST',
			data : {
				title : postTitle,
				content : postContent,
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


	function editNotice(id){
		let editTitle = $('#title_'+id).val();
		let editContent = $('#content_'+id).val();
		$.ajax({
			url : '/admin/'+id+'/edit-post',
			type : 'PATCH',
			data : {
				title : editTitle,
				content : editContent,
				_method : 'PATCH',
				_token : '{{ csrf_token() }}'
			},
			success : function(data){
				console.log(data);
				if(data){
					window.location.reload();
				sessionStorage.reloadAfterPageLoad = true;
				}
			},
			error : function(data){
				console.log(data);
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