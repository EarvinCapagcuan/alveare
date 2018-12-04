$(document).on("DOMContentLoaded", ()=>{

	/*edit project*/
/*	$(document).off('click', '#edit-project').on('click', '#edit-project', function(e){
		e.preventDefault();
		let id = $(e.target).attr('data-id');
		let title = $('#title-'+id).val();
        let batch = $('#batch-'+id).val();
        let deadline = $('#deadline-'+id).val();
        let req = $('#req-'+id).val();

        $.ajax({
            url : '/admin/edit-project/'+id,
            type : 'PATCH',
            data : {
                id : id,
                _method : 'PATCH',
                _token : '{{ csrf_token() }}'
            },
            success : function(data){
                console.log(data);
            },
            error : function(jqXHR ,settings, data){
                console.log(data);
            }
        }); 
    });*/
/*		$.ajax({
			url : "",
			type : "POST",
			data : {

			},
			success : function(data){

			},
			error : function(){

			}
		});
	});*/
	/*create project */
	/*$(document).off('click','#create-project').on('click', '#create-project', function(e){

		let id = $(e.taget).attr('data-id');
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
                batch : batch,
                deadline : deadline,
                req : req,
                _token : '{{ csrf_token() }}'
            },
            success : function(data){
                console.log(data);
                UIkit.notification('Project saved!');
            },
            error : function(jqXHR){
                console.log(jqXHR);
                UIkit.notification('There was an error in saving the project!');
            }
        });
    });*/
});