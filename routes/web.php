<?php

use App\User;
use Illuminate\Support\Facades\Input;
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
Auth::routes();

Route::get('/', 'HomeController@profile');
Route::get('/profile', 'HomeController@profile');
Route::get('/home', 'HomeController@profile');
Route::get('/main', 'HomeController@main');


/*error when account does not have authorization*/
Route::get('/unauthorized', function(){
	return view('/unauthorized');
});

/*view accounts*/
Route::get('/admin/student-list', 'HomeController@student_list');
Route::get('/admin/batch-{id}/student-list', 'HomeController@student_batch_list');
Route::get('/admin/instructor-list', 'HomeController@instructor_list');
Route::get('/admin/batch-{id}/list', 'BatchController@studentList');
Route::get('/batch-{id}/projects-list', 'ProjectController@projectsStudent');
Route::get('/admin/batch-list', 'BatchController@startBatch');
Route::get('/admin/batch-{id}', 'BatchController@listBatch');
Route::get('/admin/users/{q}' , 'HomeController@accounts');

/*edit accounts*/
Route::post('/admin/edit/instructor/{id}', 'HomeController@edit_instructor');
Route::patch('/admin/update-profile-{id}', 'HomeController@update_account');
Route::patch('/admin/edit-project/{id}', 'ProjectController@edit');

/*create*/
Route::post('/admin/create-project', 'ProjectController@create');
Route::post('/admin/{id}/create-post', 'NoticeController@post');
Route::post('/admin/start-batch', 'BatchController@create');

/*notices*/
Route::get('/{id}/announcements', 'NoticeController@show');
Route::patch('/admin/{id}/edit-post', 'NoticeController@edit');

Route::delete('/admin/confirmDeact-{id}', 'HomeController@delete');
Route::patch('/admin/reactivateAcc-{id}', 'HomeController@reactivate');

/*view projects level 3|2*/
Route::get('/admin/{status}/{level}-{instructor}/projects', 'ProjectController@show');
Route::get('/admin/{id}/received-projects', 'ProjectController@showReceived');

/*approve a project*/
Route::patch('/approve-project-{id}', 'ProjectController@approveProject');
Route::get('/student-{id}/submit-project-{project}', 'ProjectController@submitProject');
Route::patch('/admin/close-project/{id}', 'ProjectController@close');

Route::get('/','HomeController@searchIndex');
Route::get('/search','HomeController@search');