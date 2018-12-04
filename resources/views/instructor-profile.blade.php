@extends('layouts/app')

@section('title', 'Instructor Profile')

@if((Auth::User()) && (Auth::User()->level_id == 2))

@section('content')
<div class="row">
    <div class="col-lg-6 py-1 px-0 my-auto">
        <h2>Account Information</h2>   
    </div>
    <div class="col-lg-6 py-1 px-0 my-auto text-right">
        <h4>Instructor</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 py-3">
        <div class="col-lg-6">{{ Auth::User()->full_name }}</div>
        <div class="col-lg-6">Edit</div>
        <div>{{ Auth::User()->email }}</div>
    </div>
</div>
<div class="card-deck m-auto">
    <div class="card">
        <div class="card-header">
            <h4>Students<span class="badge bg-light">1</span></h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="/admin/batch-{{ Auth::User()->batch_id }}/student-list">Check Student Info</a></li>
            </ul>
        </div>
    </div>
    <div class="card"> 
        <div class="card-header">
            <h4>Projects<span class="badge bg-light">1</span></h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="#project-modal" uk-toggle>Start a Project</a></li>
                <li class="list-group-item"><a href="/admin/All/{{ Auth::User()->level_id }}-{{ Auth::User()->id }}/projects">Check Project list and status</a></li>
                <li class="list-group-item"><a href="/admin/{{ Auth::User()->id }}/received-projects">Check Recieved Projects</a></li>
            </ul>
        </div>
    </div>
    <div class="uk-card-default">
        <div class="uk-card-header">
            <h3>Announcements</h3>
        </div>
        <div class="uk-card-body">
            {{ App\Notice::find('user_id') }}
        </div>
        <div class="uk-card-footer">
            <span class="uk-text-right uk-position-bottom">
                <a href="#">See all announcements</a>
            </span>
        </div>
    </div>

    <!-- <div class="card">
        <div class="card-header">
            <h4>Notices<span class="badge bg-light">1</span></h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Create an annoucement</a></li>
                <li class="list-group-item"><a href="#">Edit an Announcement</a></li>
                <li class="list-group-item"><a href="/{{ Auth::User()->id }}/announcements">See all announcements</a></li>
            </ul>
        </div>
    </div> -->
</div>
<!-- modal for creating projects -->
<div class="uk-modal-full" id="project-modal" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="uk-grid-collapse uk-flex-middle" uk-grid>
            <div class="uk-background-cover uk-width-1-4@md uk-width-1-4@s" style="background-color: gray;" uk-height-viewport>

            </div>
            <div class="uk-width-3-4@md uk-width-3-4@s uk-padding-large">
                <h3 class="uk-text-center">Create a Project</h3>
                <form class="uk-form-stacked">
                    <label class="uk-form-label" for="title">Project Title</label>
                    <div class="uk-form-control">
                        <input type="text" class="uk-input" name="title" id="title" placeholder="Project Title"></input>
                    </div>
                    <div class="uk-child-width-1-2" uk-grid>
                        <div class="uk-width-1-2">
                            <label class="uk-form-label" for="batch">Batch</label>
                            <div class="uk-form-control">
                                <input type="text" class="uk-input uk-disabled" name="batch" id="batch" value="{{ Auth::User()->batch->batch_name }}">
                                <!-- 
                                <select name="batch" id="batch" class="uk-select">
                                    @foreach(App\Batch::all() as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                    @endforeach
                                </select> -->
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <label class="uk-form-label" for="deadline">Deadline</label>
                            <div class="uk-form-control">
                                <input class="uk-input date" name="deadline" id="deadline" placeholder="Deadline"></input>
                            </div>
                        </div>
                    </div>
                    <label class="uk-form-label" for="req">Project Requirements</label>
                    <div class="uk-form-control">
                        <textarea class="uk-textarea" id="req" name="req"></textarea>
                    </div>
                    <div class="uk-button-group my-3">
                        <button class="uk-button uk-button-secondary" type="submit" id="create-project" data-id="{{ Auth::User()->id }}" onClick="create({{ Auth::User()->id }})">Create Project</button>
                        <button class="uk-modal-close uk-button" type="button" >Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function create(id){
        let title = $('#title').val();
        let batch = $('#batch').val();
        let deadline = $('#deadline').val();
        let req = $('#req').val();

          $.ajax({
            url : "/admin/create-project",
            type : "POST",
            data :{
                id  : id,
                title : title,
                batch_id : batch,
                deadline : deadline,
                req : req,
                '_token' : '{{ csrf_token() }}'
            },
            success : function(data){
                console.log(data);
                if (data == "success") {
                    UIkit.notification('Works!');
                }else{
                    UIkit.notification('There was an error in saving the project!');
                }
            }
        });
    }
</script>
@endsection

@else
    <script type="text/javascript">
        window.location="/unauthorized";
    </script>
@endif