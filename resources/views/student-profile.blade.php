@extends('layouts/app')

@section('title', 'Student Profile')

@if((Auth::User()) && (Auth::User()->level_id == 1))
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3>Announcements</h3>
        @foreach(App\Notice::all() as $notice)
        <div>   
            @if($notice->instructor_id == Auth::User()->senior_id)
            <div class="card">
                {{ $notice->title }}
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-lg-5 my-auto">
        <h3>Account Information</h3>
    </div>
    <div class="col-lg-6 text-right">
        <h4>Student</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 py-3">
        <div class="row">
            <div class="col-lg-8">
                <div>{{ Auth::User()->full_name }}</div>
                <div>{{ Auth::User()->email }}</div>
                <div>{{ Auth::User()->contact }}</div>
            </div>
            <div class="col-lg-3 text-right">
                <a href="">Update contact information</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card-deck m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Projects</h4>
            </div>
            <div class="card-body">
                <a href="/batch-{{ Auth::User()->batch_id }}/projects-list">Projects List</a>
            </div>
        </div>
    </div>
</div>
@endsection
@else
    <script type="text/javascript">
        window.location="/unauthorized";
    </script>
@endif