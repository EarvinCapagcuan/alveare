@extends('layouts/app')

@section('title', 'Main')

@section('content')
<div class="row">
	<div class="col m-auto">
		<h3>Main</h3>
		<div class=" my-0 p-0 m-auto uk-flex uk-flex-around@s">
			<div class="uk-card uk-card-default border m-3">
				<div class="uk-card-body  text-center">
					<i uk-icon="icon:user; ratio:4"></i>
					<div class="uk-card-footer">
						<h4>User Count&nbsp;<span class="uk-badge">2</span></h4>
					</div>
				</div>
			</div>
			<div class="uk-card uk-card-default border m-3">
				<div class="uk-card-body text-center">
					<i uk-icon="icon:user; ratio:4"></i>
					<div class="uk-card-footer">
						<h4>Instructors&nbsp;<span class="uk-badge">2</span></h4>
					</div>
				</div>
			</div>
			<div class="uk-card uk-card-default border m-3">
				<div class="uk-card-body text-center">
					<i uk-icon="icon:user; ratio:4"></i>
					<div class="uk-card-footer">
						<h4>Projects&nbsp;<span class="uk-badge">2</span></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col m-auto my-3 pt-1">
		<div class="uk-card-default  border mx-3">
			<div class="uk-card-header">
				<h4>some information</h4>
			</div>
			<div class="uk-card-body">
				
			</div>
		</div>
	</div>
</div>
@endsection