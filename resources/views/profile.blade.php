@extends('layouts/template')

@section('title', 'Profile')

@section('content')

@if (session('status'))
<div class="alert alert-success">
	{{ session('status') }}
</div>
<span>{{ $profile }}</span>
@endif

@endsection