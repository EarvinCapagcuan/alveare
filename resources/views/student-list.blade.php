@extends('layouts/app')

@section('title', 'Student List')

@section('content')
<div class="">
	<h4>Students list</h4>
</div>
<div>
	<table border="1">
		<thead>
			<th>name</th>
			<th>email</th>
			<th>contact number</th>
			@if(Auth::User()->level_id == 3)
			<th>instructor</th>
			@endif
			<th>actions</th>
		</thead>
		<tbody>
		@foreach($students as $student)
			<tr>
				<td>{{ $student->full_name }}</td>
				<td>
					{{ $student->email 	}}
				</td>
				<td align="center">
					{{ $student->contact }}
				</td>
				@if(Auth::User()->level_id == 3)
				<td align="center">
					{{ $student->senior_id }}
				</td>
				@endif
				<td align="center">
					<a href="">O</a>
					<a href="">X</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection