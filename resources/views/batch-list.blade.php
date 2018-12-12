@extends('layouts/app')

@section('title', 'Batches')

@section('content')
	<div class="row">
		<div class="col">
			<h3>Batches</h3>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<a href="#addBatch" class="uk-button uk-button-text" uk-toggle>Add a new Batch</a>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<table class="uk-table uk-table-striped">
				<thead>
					<th>Batch Name</th>
					<th>Slots</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach($batches as $batch)
					<tr>
						<td>{{ $batch->batch_name }}</td>
						<td>
							@php
							$x = 0;
							@endphp
							@foreach(App\User::all() as $user)
								@if($user->batch_id == $batch->id )
								@php
								$x++
								@endphp
								@endif
							@endforeach
							{{ $x!=0 ? $x-1 : 0 }}/{{ $batch->slot }} occupied</td>
						<td><a href="#studentList-{{ $batch->id }}" class="uk-button uk-button-secondary" onClick="studentList({{ $batch->id }})" uk-toggle>List</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="row" id="batch">
		
	</div>

	<!-- modal for adding batch -->
	<div id="addBatch" uk-modal>
		<div class="uk-modal-dialog">
			<button class="uk-modal-close-default" type="button" uk-close></button>
			<div class="uk-modal-header">
				<div class="uk-modal-title">Add a new batch</div>
			</div>
			<div class="uk-modal-body">
				<form>
					<label class="uk-form-label" for="batchName">Batch Name</label>
					<div><em>Pattern: Month-Time-Year</em></div>
					<div class="uk-form-controls">
						<select name="month" id="month" class="month uk-select uk-width-1-3">
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
						-
						<select name="time" id="time" class="time uk-select uk-width-1-3">
							<option value="Morning">Morning</option>
							<option value="Evening">Evening</option>
						</select>
						-
						<select name="year" id="year" class="batchName uk-select uk-width-1-5">
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>
						</select>

						{{-- <input type="text" name="batchName" id="batchName" pattern="(January|February|March|April|May|June|July|August|September|October|November|December)[-](Morning|Evening)[-][0-9]{4}">
						<br><small>Pattern: <em>Month-Month-Year</em></small> --}}
					</div>
					<label class="uk-form-label" for="slots">Slots</label>
					<div class="uk-form-controls">
						<input type="number" name="slots" id="slots" min="1" max="50">
					</div>
				</div>
				<div class="uk-modal-footer">
					<button class="uk-button" type="button" onClick="addBatch()">Save</button>
				</div>
			</form>
		</div>
	</div>
	@foreach($batches as $batch)

	<!-- modal list of students -->
	<div id="studentList-{{ $batch->id }}" uk-modal>
		<div class="uk-modal-dialog" uk-overflow-auto>
			<button class="uk-modal-close-default" type="button" uk-close></button>
			<div class="uk-modal-header">
				<div class="uk-modal-title">Instructor and students</div>
			</div>
			<div class="uk-modal-body">
				<table class="uk-table">
					<thead>
						<th>Name</th>
					</thead>
					<tfoot>
						<tr>
							<td colspan="2"><em>End of Record*</em></td>
						</tr>
					</tfoot>
					<tbody id="studentlist-{{ $batch->id }}">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endforeach

<script type="text/javascript">
	function studentList(id){
		$('#studentlist-'+id).html("");
		$('#studentlist-'+id).append();
		$.ajax({
			url : '/admin/batch-'+id+'/list',
			type : 'GET',
			dataType : 'json',
			data : {
				_method : 'GET',
				_token : '{{ csrf_token() }}'
			},
			success : function(data){
				if(data != ''){
					$.each(data, function (key, column){
						$('#studentlist-'+id).append("<tr><td>"+data[key].firstname+" "+data[key].lastname+"</td><td>"+(data[key].level_id == 1 ? "Student" : "Instructor") +"</td></tr>");
					});
				}else{
					$('#studentlist-'+id).html('<tr><td colspan=2>No Data.&nbsp;<a href="{{route('register')}}">Add a student now?</a></td></tr>');
				}
			},
			error : function(jXHR){
				console.log(jXHR);
			}
		});
	}

	function addBatch(){
		let batchName = $('#month').val()+'-'+$('#time').val()+'-'+$('#year').val();
		let slots = $('#slots').val();
		console.log(batchName+" "+slots);

		$.ajax({
			url : '/admin/start-batch',
			type : 'POST',
			data : {
				batchName : batchName,
				slots : slots,
				_method : 'POST',
				_token : '{{ csrf_token() }}'
			},			success : function(data){
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