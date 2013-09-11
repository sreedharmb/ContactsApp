<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	// return View::make('hello');
	if (Auth::check()) {
		return Redirect::to('home');
	}
	else
	{
		return Redirect::to('login');
	}

});

/**
 * Route to login.
 */
Route::post('login', function()
{
	$creds = array(
		'usr_email' => Input::get('username'), 
		'password' => Input::get('password') );

	if (Auth::attempt($creds)) {
		return Redirect::to('home');
	}
	else
	{
		return "Enter correct username and password";
	}

});

Route::get('logout', function()
{
	Auth::logout();
	//generate logout view and link to navigate to login page
	return "logged out";	
});

//to register a new user
Route::post('register', 'UserController@storeUser');

//to delete
// Route::delete('user/{id}', 'UserController@deleteUser');



// Route::group(array('before' => 'Auth'), function(){
		
	Route::get('home', function()
	{
		return "hello user";
	});


	Route::resource('group', 'ContactsGroupController');
	Route::resource('contact', 'ContactController');
	// Route::resource('contact/number', 'ContactNumberController');
	// Route::resource('contact/email', 'ContactEmailController');

	Route::get('group/{id}/contacts', 'MiscController@category');

	Route::get('trashed/contacts', 'MiscController@trashed');

	Route::get('favourites', 'MiscController@favourites');

	Route::put('favourites/{id}', 'MiscController@updateFavourite');

	Route::delete('trashed/empty', 'MiscController@emptyTrashed');

	Route::put('user/preference', 'UserController@updateUserPreference');

	Route::get('user/preference', 'UserController@showUserPreference');

	Route::delete('user/{id}', 'UserController@deleteUser');

// });



// Route::post('user', function(){
// 	$user = new User;
// 	$user->usr_email = 'sreedhar.badrinath@knolskape.com';
// 	$user->usr_password = Hash::make('sreedhar');
// 	$user->save();
// });