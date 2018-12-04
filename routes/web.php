 <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/welcome', function(){
	return view('welcome');
});

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/*user level view*/
Route::get('/student', 'HomeController@student');
Route::get('/instructor', 'HomeController@instructor');
Route::get('/manager', 'HomeController@manager');

/*error when account does not have authorization*/
Route::get('/unauthorized', function(){
	return view('/unauthorized');
});

/*view accounts*/
Route::get('/admin/student-list', 'HomeController@student_list');
Route::get('/admin/batch-{id}/student-list', 'HomeController@student_batch_list');
Route::get('/admin/instructor-list', 'HomeController@instructor_list');

/*edit accounts*/
Route::post('/admin/edit/instructor/{id}', 'HomeController@edit_instructor');

/*create*/
Route::post('/admin/create-project', 'ProjectController@create');
Route::post('/admin/{id}/create-post', 'NoticeController@post');

/*notices*/
Route::get('/{id}/announcements', 'NoticeController@show');

Route::patch('/admin/edit-project/{id}', 'ProjectController@edit');
Route::patch('/admin/close-project/{id}', 'ProjectController@close');

/*view projects level 3|2*/
Route::get('/admin/{status}/{level}-{instructor}/projects', 'ProjectController@show');
Route::get('/admin/{id}/received-projects', 'ProjectController@showReceived');

/*project list - student view*/
Route::get('/batch-{id}/projects-list', 'ProjectController@projectsStudent');

/*approve a project*/
Route::patch('/approve-project-{id}', 'ProjectController@approveProject');

Route::get('/student-{id}/submit-project-{project}', 'ProjectController@submitProject');