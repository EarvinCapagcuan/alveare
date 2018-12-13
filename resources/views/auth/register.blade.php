@extends('layouts/app')

@section('title', 'Register')

@section('content')
@if(Auth::User() && Auth::User()->level_id == 3)
<div class="row">
    <div class="col">
        <h3>Register</h3>
    </div>
</div>
<div class="row p-0 m-auto">
    <div class="col-5 mx-auto pr-2 border-right">
        <h4>Personal Information</h4>
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <label for="firstname" class="col-11 control-label">First name</label>
                <div class="col-11">
                    <input id="firstname" type="text" class="form-control uk-input" name="firstname" value="{{ old('firstname') }}" required autofocus>
                    @if ($errors->has('firstname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                <label for="middlename" class="col-11 control-label">Middle name</label>
                <div class="col-11">
                    <input id="middlename" type="text" class="form-control uk-input" name="middlename" value="{{ old('middlename') }}" required>
                    @if ($errors->has('middlename'))
                    <span class="help-block">
                        <strong>{{ $errors->first('middlename') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="lastname" class="col-11 control-label">Last name</label>
                <div class="col-11">
                    <input id="lastname" type="text" class="form-control uk-input" name="lastname" value="{{ old('lastname') }}" required>
                    @if ($errors->has('lastname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group m-auto pb-2 text-center">
                <label for="gender" class="col-11 control-label">Gender</label>
                <div class="col-11">
                    @foreach( App\Gender::all() as $gender )
                    <input type="radio" name="gender" id="gender" class="uk-radio" value="{{ $gender->id }}">{{ $gender->name }}</input>
                    @endforeach
                </div>
            </div>
            <div class="uk-flex uk-flex-between">
                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                    <label for="contact" class="col-12 control-label">Contact Number</label>
                    <div class="col-10">
                        <input id="contact" type="tel" pattern="[0-9]{11}" class="form-control uk-input" name="contact" placeholder="09xxxxxxxxx" value="{{ old('contact') }}" required >
                        @if ($errors->has('contact'))
                        <span class="help-block">
                            <strong>{{ $errors->first('contact') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="dob" class="col-12 control-label">Date of Birth</label>
                    <div class="col-11">
                        <input type="text" name="dob" class="uk-input date" id="dob"></input>
                    </div>
                </div>
            </div>
    </div>  
    <div class="col-6 mx-auto m-0 p-0">
        <h4>Position</h4>
        <div class="form-group mb-2">
            <label for="senior" class="col-10 control-label">Handler</label>
            <div class="col-10">
                <select id="senior" class="form-control uk-input uk-disabled uk-text-muted" name="senior" value="{{ old('senior') }}" uk-tooltip="title: Disabled">
                    @foreach(App\User::whereIn('Level_id', [2,3])->get() as $senior)
                    <option value="{{ $senior->id }}" {{ Auth::User()->id == $senior->id ? "selected" : "" }} >{{ ucwords($senior->full_name)." - ". $senior->level->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('level_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('level_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="batch" class="col-10 control-label">Batch</label>
            <div class="col-10">
                <select id="batch" class="form-control uk-select" name="batch" value="{{ old('batch') }}" required>
                    @foreach(App\Batch::all() as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                    @endforeach
                </select>

                <span class="help-block">
                    <strong>{{ $errors->first('batch_id') }}</strong>
                </span>

            </div>
        </div>
        <div class="form-group{{ $errors->has('level_id') ? ' has-error' : '' }}">
            <label for="level_id" class="col-10 control-label">Level (Instructor/student)</label>

            <div class="col-10">
                <select id="level_id" class="form-control uk-input" name="level_id" value="{{ old('level_id') }}" required>
                    @foreach(App\Level::all() as $level_id)
                    <!-- @if($level_id->id == 1 || $level_id->id == 2) -->
                    <option value="{{ $level_id->id }}">{{ $level_id->name }}</option>
                    <!-- @endif -->
                    @endforeach
                </select>
                @if ($errors->has('level_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('level_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
        {{-- email section --}}
        <div class="col m-auto pt-2 p-0">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-10 control-label">E-Mail Address</label>
                <div class="col-10">
                    <input id="email" type="email" class="form-control uk-input" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="uk-flex uk-flex-left">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-10 control-label">Password</label>
                    <div class="col-10">
                        <input id="password" type="password" class="form-control uk-input" name="password" required>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="col-10 control-label">Confirm Password</label>

                    <div class="col-10">
                        <input id="password-confirm" type="password" class="form-control uk-input" name="password_confirmation" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-auto pt-3">
        <div class="col m-auto">   
                <div class="form-group">
                    <div class="col-11 text-center">
                        <button type="submit" class="uk-button uk-button-large">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>
@elseif(Auth::User() && Auth::User()->level_id != 3)
<script type="text/javascript">
    window.location = '/unauthorized';
</script>
@else
<script type="text/javascript">
    window.location = '/unauthorized';
</script>
@endif
@endsection