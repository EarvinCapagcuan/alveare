@extends('layouts/app')

@section('title', 'Manager Profile')

@if((Auth::User()) && (Auth::User()->level_id == 3))
@section('content')
<div class="row">
    <div class="col-lg-6 py-1 px-0 my-auto">
        <h2>Account Information</h2>   
    </div>
    <div class="col-lg-6 py-1 px-0 my-auto text-right">
        <h4>Manager</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 py-3">
        <div>{{ Auth::User()->full_name }} <button class="btn" uk-toggle onClick="">Edit</button></div>
        <div>{{ Auth::User()->email }}</div>
    </div>
</div>
<div class="card-deck m-auto">
    <div class="card">
        <div class="card-header">
            <h4>Accounts</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('register') }}">Add an Instructor</a></li>
                <li class="list-group-item"><a href="/admin/instructor-list">Check User Info</a></li>
            </ul>
        </div>
    </div>
    <div class="card"> 
        <div class="card-header">
            <h4>Projects<span class="badge bg-light">1</span></h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="/admin/All/{{ Auth::User()->id }}-{{ Auth::User()->level_id }}/projects">Review Instructor Projects</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
@else
    <script type="text/javascript">
        window.location="/unauthorized";
    </script>
@endif