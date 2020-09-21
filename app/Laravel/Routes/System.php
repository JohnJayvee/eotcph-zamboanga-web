<?php

/*,'domain' => env("FRONTEND_URL", "wineapp.localhost.com")*/
Route::group(['as' => "system.",
		 'namespace' => "System",
		 'middleware' => ["web"],
		 // 'domain' => env('SYSTEM_URL',''),
		 'prefix' => "admin"
		],function() {


Route::group(['as' => "auth."], function(){
		Route::get('login/{uri?}',['as' => "login",'uses' => "AuthController@login","middleware" => "system.guest"]);
		Route::post('login/{uri?}',['uses' => "AuthController@authenticate","middleware" => "system.guest"]);
		Route::get('register', [ 'as' => "register",'uses' => "AuthController@register","middleware" => "system.guest"]);
		Route::post('register', [ 'uses' => "AuthController@store","middleware" => "system.guest"]);
		Route::get('activate', [ 'as' => "activate",'uses' => "AuthController@activate","middleware" => "system.guest"]);
		Route::post('activate', [ 'uses' => "AuthController@activate_account","middleware" => "system.guest"]);
		Route::get('change-password', [ 'as' => "change_password",'uses' => "AuthController@change","middleware" => "system.guest"]);
		Route::post('change-password', [ 'uses' => "AuthController@setup_password","middleware" => "system.guest"]);
		Route::get('logout',['as' => "logout",'uses' => "AuthController@logout","middleware" => "system.auth"]);
		Route::any('get-municipalities',['as' => "get_municipalities", 'uses' => "AuthController@get_municipalities"]);
	});
	Route::group(['middleware' => "system.auth"],function(){

		Route::get('/',['as' => "dashboard",'uses' => "MainController@dashboard"]);

		Route::group(['as' => "transaction.",'prefix' => "transaction"], function(){
			Route::get('/',['as' => "index",'uses' => "TransactionController@index"]);
			Route::get('show/{id?}',['as' => "show",'uses' => "TransactionController@show",'middleware' => "system.exist:transaction"]);
			Route::get('process/{id?}',['as' => "process",'uses' => "TransactionController@process",'middleware' => "system.exist:transaction"]);
			Route::get('requirements/{id?}',['as' => "requirements",'uses' => "TransactionController@process_requirements"]);
			Route::any('delete/{id?}',['as' => "destroy",'uses' => "TransactionController@destroy"]);
		});


		Route::group(['as' => "profile.",'prefix' => "profile"], function(){
			Route::get('/',['as' => "index",'uses' => "ProfileController@index"]);
			Route::get('edit',['as' => "edit",'uses' => "ProfileController@edit"]);
			Route::post('edit',['uses' => "ProfileController@update"]);
			Route::post('image',['as' => "image.edit",'uses' => "ProfileController@update_image"]);
			Route::get('password',['as' => "password.edit",'uses' => "ProfileController@edit_password"]);
			Route::post('password',['uses' => "ProfileController@update_password"]);
		});

		Route::group(['as' => "department.",'prefix' => "department"], function(){
			Route::get('/',['as' => "index",'uses' => "DepartmentController@index"]);
			Route::get('create',['as' => "create",'uses' => "DepartmentController@create"]);
			Route::post('create',['uses' => "DepartmentController@store"]);
			Route::get('edit/{id?}',['as' => "edit",'uses' => "DepartmentController@edit",'middleware' => "system.exist:department"]);
			Route::post('edit/{id?}',['uses' => "DepartmentController@update",'middleware' => "system.exist:department"]);
			Route::any('delete/{id?}',['as' => "destroy",'uses' => "DepartmentController@destroy",'middleware' => "system.exist:department"]);
			
		});
		Route::group(['as' => "other_customer.",'prefix' => "other-customer"], function(){
			Route::get('/',['as' => "index",'uses' => "OtherCustomerController@index"]);
			Route::get('create',['as' => "create",'uses' => "OtherCustomerController@create"]);
			Route::post('create',['uses' => "OtherCustomerController@store"]);
			Route::get('edit/{id?}',['as' => "edit",'uses' => "OtherCustomerController@edit",'middleware' => "system.exist:department"]);
			Route::post('edit/{id?}',['uses' => "OtherCustomerController@update",'middleware' => "system.exist:other_customer"]);
			Route::any('delete/{id?}',['as' => "destroy",'uses' => "OtherCustomerController@destroy",'middleware' => "system.exist:other_customer"]);
			Route::get('show/{id?}',['as' => "show",'uses' => "OtherCustomerController@show",'middleware' => "system.exist:other_customer"]);
		});

		Route::group(['as' => "other_transaction.",'prefix' => "other-transaction"], function(){
			Route::get('/',['as' => "index",'uses' => "OtherTransactionController@index"]);
			Route::get('create/{id?}',['as' => "create",'uses' => "OtherTransactionController@create"]);
			Route::post('store',['as' => "store",'uses' => "OtherTransactionController@store"]);
			Route::get('show/{id?}',['as' => "show",'uses' => "OtherTransactionController@show",'middleware' => "system.exist:other_transaction"]);
			// Route::get('edit/{id?}',['as' => "edit",'uses' => "DepartmentController@edit",'middleware' => "system.exist:department"]);
			// Route::post('edit/{id?}',['uses' => "DepartmentController@update",'middleware' => "system.exist:department"]);
			// Route::any('delete/{id?}',['as' => "destroy",'uses' => "DepartmentController@destroy",'middleware' => "system.exist:department"]);
		});

		Route::group(['as' => "application_requirements.",'prefix' => "application-requirements"], function(){
			Route::get('/',['as' => "index",'uses' => "ApplicationRequirementController@index"]);
			Route::get('create',['as' => "create",'uses' => "ApplicationRequirementController@create"]);
			Route::post('create',['uses' => "ApplicationRequirementController@store"]);
			Route::get('edit/{id?}',['as' => "edit",'uses' => "ApplicationRequirementController@edit",'middleware' => "system.exist:requirements"]);
			Route::post('edit/{id?}',['uses' => "ApplicationRequirementController@update",'middleware' => "system.exist:requirements"]);
			Route::any('delete/{id?}',['as' => "destroy",'uses' => "ApplicationRequirementController@destroy",'middleware' => "system.exist:requirements"]);
			
		});

		
		Route::group(['as' => "application.",'prefix' => "application"], function(){
			Route::get('/',['as' => "index",'uses' => "ApplicationController@index"]);
			Route::get('create',['as' => "create",'uses' => "ApplicationController@create"]);
			Route::post('create',['uses' => "ApplicationController@store"]);
			Route::get('edit/{id?}',['as' => "edit",'uses' => "ApplicationController@edit",'middleware' => "system.exist:application"]);
			Route::post('edit/{id?}',['uses' => "ApplicationController@update",'middleware' => "system.exist:application"]);
			Route::any('delete/{id?}',['as' => "destroy",'uses' => "ApplicationController@destroy",'middleware' => "system.exist:application"]);
		});

		Route::group(['as' => "processor.",'prefix' => "processor"], function(){
			Route::get('/',['as' => "index",'uses' => "ProcessorController@index"]);
			Route::get('create',['as' => "create",'uses' => "ProcessorController@create"]);
			Route::post('create',['uses' => "ProcessorController@store"]);
			Route::get('edit/{id?}',['as' => "edit",'uses' => "ProcessorController@edit",'middleware' => "system.exist:processor"]);
			Route::post('edit/{id?}',['uses' => "ProcessorController@update",'middleware' => "system.exist:processor"]);
			Route::get('reset/{id?}',['as' => "reset",'uses' => "ProcessorController@reset",'middleware' => "system.exist:processor"]);
			Route::post('reset/{id?}',['uses' => "ProcessorController@update_password",'middleware' => "system.exist:processor"]);
			Route::any('delete/{id?}',['as' => "destroy",'uses' => "ProcessorController@destroy",'middleware' => "system.exist:processor"]);
			Route::get('list',['as' => "list",'uses' => "ProcessorController@list"]);
			Route::get('show/{id?}',['as' => "show",'uses' => "ProcessorController@show"]);
		});
	});

	


});