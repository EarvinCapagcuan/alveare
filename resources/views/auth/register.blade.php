@extends('layouts/app')

@section('title', 'Register')

@section('content')
<div class="panel-heading">Register</div>

<div class="panel-body">
    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
            <label for="firstname" class="col-md-4 control-label">First name</label>

            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>
                @if ($errors->has('firstname'))
                <span class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
            <label for="middlename" class="col-md-4 control-label">Middle name</label>
            <div class="col-md-6">
                <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}" required>
                @if ($errors->has('middlename'))
                <span class="help-block">
                    <strong>{{ $errors->first('middlename') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
            <label for="lastname" class="col-md-4 control-label">Last name</label>
            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>
                @if ($errors->has('lastname'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
            <label for="contact" class="col-md-4 control-label">Contact Number</label>
            <div class="col-md-6">
                <input id="contact" type="tel" pattern="[0-9]{11}" class="form-control" name="contact" placeholder="09xxxxxxxxx" value="{{ old('contact') }}" required >
                @if ($errors->has('contact'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="dob" class="col-md-4 control-label">Date of Birth</label>
            <div class="col-md-6">
                <input type="text" name="dob" class="date" id="dob"></input>
            </div>
        </div>
        <div class="form-group">
            <label for="gender" class="col-md-4 control-label">Gender</label>
            <div class="col-md-6">
                @foreach( App\Gender::all() as $gender )
                <input type="radio" name="gender" id="gender" value="{{ $gender->id }}">{{ $gender->name }}</input>
                @endforeach
            </div>
        </div>
        <div class="form-group">
        <label for="senior" class="col-md-4 control-label">Handler</label>
            <div class="col-md-6">
                <select id="senior" class="form-control" name="senior" value="{{ old('senior') }}" required>
                    @foreach(App\User::whereIn('Level_id', [2,3])->get() as $senior)
                    <option value="{{ $senior->id }}">{{ $senior->firstname." ".$senior->lastname." - Level_id ".$senior->level_id }}</option>
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
        <label for="batch" class="col-md-4 control-label">Batch</label>
             <div class="col-md-6">
                <select id="batch" class="form-control" name="batch" value="{{ old('batch') }}" required>
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
            <label for="level_id" class="col-md-4 control-label">Level_id(Instructor/student)</label>

            <div class="col-md-6">
                <select id="level_id" class="form-control" name="level_id" value="{{ old('level_id') }}" required>
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
        
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">

</script>
@endsection