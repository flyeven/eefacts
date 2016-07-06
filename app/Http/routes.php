<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'FrontendController@getHomePage');
Route::get('m', 'FrontendController@redirectToHomePage');
Route::get('mobile', 'FrontendController@redirectToHomePage');
Route::get('reports', 'FrontendController@getReportsPage');
Route::get('stats', 'FrontendController@getStatsPage');
Route::get('about', 'FrontendController@getAboutPage');
Route::get('news', 'FrontendController@getNewsPage');
Route::get('useful', 'FrontendController@getUsefulPage');
Route::get('news/{slug}', 'FrontendController@getPostBySlugPage');
Route::get('tag/{tag}', 'FrontendController@getPostsListByTagPage');

Route::post('news/post/comment/add', 'FrontendController@postAddPostComment');


Route::get('admin/login', 'BackendController@getLoginPage');
Route::post('admin/login', 'AuthController@postLogin');

Route::get('admin/register', 'BackendController@getRegisterPage');
Route::post('admin/register', 'AuthController@postRegister');

Route::get('admin/logout', 'AuthController@doLogout');

Route::get('/get/rounds-json', 'DrawsController@getRoundsJson');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| This route group applies the "auth" middleware group to every route
|	unauthenticated users will be redirected to '/' (home page)
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/dashboard', 'BackendController@getDashboardPage');

	Route::get('admin/draws', 'DrawsController@getDrawsPage');
	Route::get('admin/draws/new', 'DrawsController@getNewDrawPage');
	Route::post('admin/draws/new', 'DrawsController@postNewDraw');
	Route::get('admin/draws/edit/{id}', 'DrawsController@getEditDrawPage');
	Route::post('admin/draws/edit', 'DrawsController@postEditDraw');
	Route::get('admin/draws/delete/{id}', 'DrawsController@getDeleteDrawPage');
	Route::post('admin/draws/delete', 'DrawsController@postDeleteDraw');

	Route::get('admin/posts', 'PostsController@getPostsPage');
	Route::get('admin/posts/new', 'PostsController@getNewPostPage');
	Route::post('admin/posts/new', 'PostsController@postNewPost');
	Route::get('admin/posts/edit/{id}', 'PostsController@getEditPostPage');
	Route::post('admin/posts/edit', 'PostsController@postEditPost');
	Route::get('admin/posts/delete/{id}', 'PostsController@getDeletePostPage');
	Route::post('admin/posts/delete', 'PostsController@postDeletePost');
});





