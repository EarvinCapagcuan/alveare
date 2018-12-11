@extends('layouts/app')

@section('title', 'Users List')

@section('content')
<div class="row">
	<div class="col">
		<h3>User List</h3>
	</div>
</div>
<div class="row">
	<div class="col">
		<form class="uk-search uk-search-default w-100">
			<a href="#" uk-search-icon></a>
			<input type="search" class="uk-search-input" id="search" placeholder="Search...">
			<div id="searchdiv"></div>
		</form>
	</div>
</div>
	<div>
		<table border="1" class="uk-table uk-table-striped">
			<thead>
				<th>Name</th>
				<th>Email</th>
				<th>Contact infromation</th>
				<th>Batch</th>
				@if(Auth::User()->level_id == 3)
				<th>Actions</th>
				@endif
			</thead>
			<tfoot>
				<tr>
					<td colspan="5" align="right"><em>*end of record</em></td>
				</tr>
			</tfoot>
			<tbody class="result">
				@foreach($users as $user)
				<tr>
					<td>{{ ucwords($user->full_name) }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->contact }}</td>
					<td>{{ $user->batch->batch_name}}</td>
					@if(Auth::User()->level_id == 3)
					<td>
						<a href="#edit-modal-{{ $user->id }}" class="uk-button uk-button-secondary" uk-tooltip="title: Edit" uk-toggle><i uk-icon="icon:file-edit"></i></a>&nbsp;
					</td>
					@endif
				</tr>
				@if(Auth::User()->level_id == 3)
				<div class="uk-modal-full" id="edit-modal-{{ $user->id }}" uk-modal>
					<div class="uk-modal-dialog">
						<button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
						<div class="uk-grid-collapse uk-flex-middle" uk-grid>
							<div class="uk-background-cover uk-width-1-4@s uk-width-1-4@m" style="background-color: gray;" uk-height-viewport>
							</div>
							<div class="uk-padding-large uk-padding-remove-vertical">
								<h3>Instructor Information</h3>
								<form class="uk-form-stacked" method="POST">
									{{ csrf_field() }}
									{{ method_field("PATCH") }}

									<label for="firstname" class="uk-form-label">First name</label>
									<div class="uk-form-controls">
										<input type="text" id="firstname" name="firstname" class="uk-input" value="{{ $user->firstname }}" autofocus></input>
									</div>
									<label for="middlename" class="uk-form-label">Middle name</label>
									<div class="uk-form-controls">
										<input type="text" id="middlename" name="middlename" class="uk-input" value="{{ $user->middlename }}"></input>
									</div>
									<label for="lastname" class="uk-form-label">Latst name</label>
									<div class="uk-form-controls">
										<input type="text" id="lastname" name="lastname" class="uk-input" value="{{ $user->lastname }}"></input>
									</div>
									<div class="uk-flex">
										<div>
											<label for="dob" class="uk-form-label">Date of Birth</label>
											<div class="uk-form-controls">
												<input type="text" id="dob" name="dob" class="uk-input date" value="{{ $user->dob }}"></input>
											</div>
										</div>
										<div>
											<label for="contact" class="uk-form-label">Contact Information</label>
											<div class="uk-form-controls">
												<input type="tel" pattern="[0-9]{11}" id="contact" name="contact" class="uk-input" value="{{ $user->contact }}"></input>
											</div>
										</div>
									</div>
									<label for="email" class="uk-form-label">Email</label>
									<div class="uk-form-controls">
										<input type="email" id="email" name="email" class="uk-input" value="{{ $user->email }}"></input>
									</div>
									<label for="batch" class="uk-form-label">Batch</label>
									<div class="uk-form-controls">
										<select id="batch" class="uk-select" name="batch">
											@foreach(App\Batch::all() as $batch)
											<option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
											@endforeach
										</select>
									</div>
									<label for="handler" class="uk-form-label">Handler</label>
									<div class="uk-form-controls">
										<select id="handler" class="uk-select" name="handler">
											@foreach(App\User::whereLevel_id(3)->get() as $manager)
											<option value="{{ $manager->id }}">{{ $manager->firstname." ".$manager->middlename." ".$manager->lastname }}</option>
											@endforeach
										</select>
									</div>
									<div class="uk-button-group my-2">
										<button class="uk-button" type="button" onClick="updateInfo({{ $user->id }})">Save</button>
										<button class="uk-button uk-modal-close" type="button">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#search').on('keyup', function () {
			let value = $('#search').val();
			$.ajax({
				url : '{{URL::to('search')}}',
				type : 'GET',
				data : {
					search : value,
					_token : '{{ csrf_token() }}'
				},
				success : function(data){
					if (data != '') {
						$('.result').html(data);
					}else{
						$('.result').html("<tr><td colspan={{Auth::User()->level_id==3 ? 5 : 4 }}><strong>No records found.</strong</td></tr>");
					}
				}
			});
		});
	});

	function updateInfo(id){
		let firstname = $('#firstname-'+id).val();
		let middlename = $('#middlename-'+id).val();
		let lastname = $('#lastname-'+id).val();
		let contact = $('#contact-'+id).val();
		let dob = $('#dob-'+id).val();

		$.ajax({
			url : "/admin/update-profile-"+id,
			type : "PATCH",
			data : {
				firstname : firstname,
				middlename : middlename,
				lastname : lastname,
				contact : contact,
				dob : dob,
				method : "PATCH", 
				_token : "{{ csrf_token() }}",
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