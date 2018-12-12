@extends('layouts/app')

@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col">
        <h2>Account Information</h2>   
    </div>
</div>
<div class="row uk-section">
	<div class="col">
		<div class="row">
			<div class="col">
				<h3>Welcome, {{ ucwords(Auth::User()->full_name) }}
                    @if(Auth::User()->level_id == 3)
                    &nbsp;<a href="#update-modal" class="text-right" uk-tooltip="Update Information" uk-toggle><i uk-icon="icon: file-edit"></i></a>
                    @endif
                </h3>
            </div>
        </div>
        <div class="row">
         <div class="col">
            <div class="uk-card uk-card-small uk-card-default">
               <div class="uk-card-header">
                  <span>{{ Auth::User()->level->name }}</span>
              </div>
              <div class="uk-card-body">
                  <ul class="uk-list">
                    @if(Auth::User()->level_id != 3)
                    <li>Batch: {{ Auth::User()->batch->batch_name }}</li>
                    <li>Senior: {{ ucwords(Auth::User()->senior->full_name) }}</li>
                    @endif
                    <li>Date of birth: {{ Auth::User()->dob->format('d/m/Y') }}</li>
                    <li>email: {{ Auth::User()->email }}</li>
                    <li>contact number: {{ Auth::User()->contact }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="uk-card uk-card-small uk-card-default">
           <div class="uk-card-header">
              Last Login Information
          </div>
          <div class="uk-card-body">
              <ul class="uk-list">
                 <li>Last login {{ Auth::User()->last_login_at->diffForHumans() }}</li>
                 <li>IP {{ Auth::User()->last_login_ip }}</li>
             </ul>
         </div>
     </div>
 </div>
</div>
</div>
</div>

<!-- modal to update manager profile -->
<div id="update-modal" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="uk-grid-collapse uk-child-width-1-2@s uk-child-width-1-2@md uk-flex-middle" uk-grid>
            <div class="uk-background-cover uk-width-1-4@s uk-uk-width-3-4@md" style="background-color: gray;" uk-height-viewport>
            </div>
            <div class="uk-padding-large">
                <h3>Update Information</h3>
                <form class="uk-form-stacked">
                    <label for="firstname" class="uk-form-label">First name</label>
                    <div class="uk-form-control">
                        <input type="text" id="firstname" name="firstname" class="uk-input" value="{{ Auth::User()->firstname }}" autofocus></input>
                    </div>
                    <label for="middlename" class="uk-form-label">Middle name</label>
                    <div class="uk-form-control">
                        <input type="text" id="middlename" name="middlename" class="uk-input" value="{{ Auth::User()->middlename }}"></input>
                    </div>
                    <label for="lastname" class="uk-form-label">Latst name</label>
                    <div class="uk-form-control">
                        <input type="text" id="lastname" name="lastname" class="uk-input" value="{{ Auth::User()->lastname }}"></input>
                    </div>
                    <label for="dob" class="uk-form-label">Date of Birth</label>
                    <div class="uk-form-control">
                        <input type="text" id="dob" name="dob" class="uk-input date" value="{{ Auth::User()->dob->format('Y-m-d') }}"></input>
                    </div>
                    <label for="contact" class="uk-form-label">Contact Information</label>
                    <div class="uk-form-control">
                        <input type="tel" pattern="[0-9]{7,11}" id="contact" name="contact" class="uk-input" value="{{ Auth::User()->contact }}"></input>
                    </div>
                    <label for="email" class="uk-form-label">Email</label>
                    <div class="uk-form-control">
                        <input type="email" id="email" name="email" class="uk-input uk-disabled" disabled value="{{ Auth::User()->email }}"></input>
                    </div>
                    <div class="uk-button-group my-2">
                        <button class="uk-button" type="button" onClick="updateProfile({{ Auth::User()->id }})">Save</button>
                        <button class="uk-button uk-close-modal" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function updateProfile(id){
        let firstname = $('#firstname').val();
        let middlename = $('#middlename').val();
        let lastname = $('#lastname').val();
        let dob = $('#dob').val();
        let contact = $('#contact').val();

        $.ajax({
            url : '/admin/update-profile-'+id,
            type : 'PATCH',
            data : {
                firstname : firstname,
                middlename : middlename,
                lastname : lastname,
                contact : contact,
                dob : dob,
                _method : 'PATCH',
                _token : '{{ csrf_token() }}'
            },
            success : function(data){
                if(data){
                    console.log(data);
                    window.location.reload();
                    sessionStorage.reloadAfterPageLoad = true;
                }
            },
            error : function(data){
                console.log(data);
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