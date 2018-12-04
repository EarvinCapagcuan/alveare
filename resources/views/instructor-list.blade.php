@extends('layouts/app')

@section('title', 'Instructors List')

@section('content')
<h4>Instructors List</h4>
<form class="uk-search uk-search-default w-100">
	<a href="#" uk-search-icon></a>
	<input type="search" class="uk-search-input" placeholder="Search..."></input>
</form>

<table border="1" class="uk-table uk-table-striped">
	<thead>
		<th>Name</th>
		<th>Email</th>
		<th>Contact infromation</th>
		<th>Batch</th>
		<th>Actions</th>
	</thead>
	<tfoot>
		<tr>
			<td colspan="5" align="right"><em>*end of record</em></td>
		</tr>
	</tfoot>
	<tbody>
		@foreach($instructors as $instructor)
		<tr>
			<td>{{ $instructor->full_name }}</td>
			<td>{{ $instructor->email }}</td>
			<td>{{ $instructor->contact }}</td>
			<td>{{ $instructor->batch->batch_name}}</td>
			<td>
				<a href="#edit-modal" class="uk-button uk-button-primary" uk-toggle>O</a>&nbsp;
				<!-- <button class="btn m-1" onClick="editInfo({{ $instructor->id }})">O</button> -->
			 	<a href="/admin/delete/{{ $instructor->id }}">X</a>
			</td>
			</tr>
			<div class="uk-modal-full" id="edit-modal" uk-modal>
				<div class="uk-modal-dialog">
					<button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
					<div class="uk-grid-collapse uk-child-width-1-2@s uk-child-width-1-2@md uk-flex-middle" uk-grid>
						<div class="uk-background-cover uk-width-1-4@s uk-uk-width-3-4@md" style="background-color: gray;" uk-height-viewport>
							<h3>Edit Form</h3>
						</div>
						<div class="uk-padding-large">
							<h3>Instructor Information</h3>
							<form class="uk-form-stacked" method="POST">
								{{ csrf_field() }}
								{{ method_field("PATCH") }}

								<label for="firstname" class="uk-form-label">First name</label>
								<div class="uk-form-control">
									<input type="text" id="firstname" name="firstname" class="uk-input" value="{{ $instructor->firstname }}" autofocus></input>
								</div>
								<label for="middlename" class="uk-form-label">Middle name</label>
								<div class="uk-form-control">
									<input type="text" id="middlename" name="middlename" class="uk-input" value="{{ $instructor->middlename }}"></input>
								</div>
								<label for="lastname" class="uk-form-label">Latst name</label>
								<div class="uk-form-control">
									<input type="text" id="lastname" name="lastname" class="uk-input" value="{{ $instructor->lastname }}"></input>
								</div>
								<label for="dob" class="uk-form-label">Date of Birth</label>
								<div class="uk-form-control">
									<input type="text" id="dob" name="dob" class="uk-input date" value="{{ $instructor->dob }}"></input>
								</div>
								<label for="contact" class="uk-form-label">Contact Information</label>
								<div class="uk-form-control">
									<input type="tel" pattern="[0-9]{11}" id="contact" name="contact" class="uk-input" value="{{ $instructor->contact }}"></input>
								</div>
								<label for="email" class="uk-form-label">Email</label>
								<div class="uk-form-control">
									<input type="email" id="email" name="email" class="uk-input" value="{{ $instructor->email }}"></input>
								</div>
								<label for="batch" class="uk-form-label">Batch</label>
								<div class="uk-form-control">
									<select id="batch" class="uk-select" name="batch">
										@foreach(App\Batch::all() as $batch)
											<option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
										@endforeach
									</select>
								</div>
								<label for="handler" class="uk-form-label">Handler</label>
								<div class="uk-form-control">
								<select id="handler" class="uk-select" name="handler">
										@foreach(App\User::whereLevel_id(3)->get() as $manager)
										<option value="{{ $manager->id }}">{{ $manager->firstname." ".$manager->middlename." ".$manager->lastname }}</option>
										@endforeach
									</select>
								</div>
								<div class="uk-button-group my-2">
									<a href="#" class="uk-button uk-button-secondary">Send password reset Email</a>
									<button class="uk-button" type="button">Save</button>
									<button class="uk-button" type="button">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endforeach
	</tbody>
</table>


<script type="text/javascript">
	function editInfo(id){
		$.ajax({
			url : "/admin/edit/instructor/"+id,
			data : {
				"_token" : "{{ csrf_token() }}",
				"id" : "id"
			},
			type : "POST",
			success : function(data){
				console.log("edit "+data);
			}
		});
	}
</script>
@endsection