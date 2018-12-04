@extends('layouts/app')

@section('title', 'Announcements')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3>Announcements</h3>
		</div>
		<div>
			@if(Auth::User()->level_id == 2)
			<a href="#post-announcement" class="uk-button" uk-toggle>Post an announcement</a>
			@endif
		</div>
	</div>
	<div class="row">
		@foreach($notices as $notice)
		<div class="col-lg-3">
			<div class="uk-card-default">
				<div class="uk-card-header">
					{{ $notice->title }}
				</div>
				<div class="uk-card-body">
					{{ $notice->content }}
				</div>
				<div class="uk-card-footer">
					{{ $notice->created_at->diffForHumans() }}
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div id="post-announcement" uk-modal>
		<div class="uk-modal-dialog">
			<button class="uk-modal-close" uk-close></button>
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
				console.log(data);
				window.location.reload();
/*				if (data == "success") {
					console.log(data);
				}else{
					console.log('errrrrrorr');
				}*/
			}
		});
	}
</script>
@endsection