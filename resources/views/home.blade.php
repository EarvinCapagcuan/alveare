@extends('layouts/app')

@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-lg-6 py-1 px-0 my-auto">
        <h2>Account Information</h2>   
    </div>
    <div class="col-lg-6 py-1 px-0 my-auto text-right">
        @if((Auth::User()->level_id)==3)
        <h4>Manager</h4>
        @elseif((Auth::User()->level_id)==2)
        <h4>Instructor</h4>
        @else
        <h4>Student</h4>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-12 py-3">
        <div>{{ Auth::User()->firstname." ".Auth::User()->middlename." ".Auth::User()->lastname }}</div>
        <div>{{ Auth::User()->email }}</div>

    </div>
</div>
<div class="row">
    @if((Auth::User()->level_id)==3 || (Auth::User()->level_id)==2 )
    <div class="card-deck m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Students<span class="badge bg-light">1</span></h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Register a Stundent</a></li>
                    <li class="list-group-item"><a href="#"><a href="#">Check Student Info</a></li>
                </ul>
            </div>
        </div>
        <div class="card"> 
            <div class="card-header">
                <h4>Projects<span class="badge bg-light">1</span></h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Start a Project</a></li>
                    <li class="list-group-item"><a href="#">Check Project list and status</a></li>
                    <li class="list-group-item"><a href="#">Check Recieved Projects</a></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Notices<span class="badge bg-light">1</span></h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Create an annoucement</a></li>
                    <li class="list-group-item"><a href="#">Edit an Announcement</a></li>
                    <li class="list-group-item"><a href="#">See all announcements</a></li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="card-deck m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Projects</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Submit a Project</a></li>
                    <li class="list-group-item"><a href="#">Submitted Projects</a></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Grade</h4>
            </div>
            <div class="card-body">
                <div>criteria</div>
                <div>100%</div>
            </div>
        </div>
    </div>
    @endif
</div>
<span><a href='/instructor-page'>{{ url('/') }}instructor</a></span>

@endsection