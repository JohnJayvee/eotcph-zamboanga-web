<?php

Route::group(['as' => "web.",
		 'namespace' => "Web",
		 'middleware' => ["web"]
		],function() {

	
	Route::group(['prefix'=> "/",'as' => 'main.' ],function(){
		Route::get('/', [ 'as' => "index",'uses' => "MainController@index"]);
	});

	Route::get('type',['as' => "get_application_type",'uses' => "MainController@get_application_type"]);
	Route::get('amount',['as' => "get_payment_fee",'uses' => "MainController@get_payment_fee"]);
	Route::get('requirements',['as' => "get_requirements",'uses' => "MainController@get_requirements"]);
	Route::get('contact-us',['as' => "contact",'uses' => "MainController@contact"]);
	Route::any('logout',['as' => "logout",'uses' => "AuthController@destroy"]);

	Route::group(['middleware' => ["web","portal.guest"]], function(){
		Route::get('login/{redirect_uri?}',['as' => "login",'uses' => "AuthController@login"]);
        Route::post('login/{redirect_uri?}',['uses' => "AuthController@authenticate"]);
		Route::get('verify/{id?}',['as' => "verify",'uses' => "AuthController@verify"]);
        Route::post('verify/{id?}',['uses' => "AuthController@verified"]);

    /*  Route::get('forgot-password',['as' => "forgot_password",'uses' => "AuthController@forgot_pass"]);
        Route::post('change-password',['as' => "change_password",'uses' => "AuthController@change_password"]);*/
		Route::group(['prefix'=> "register",'as' => 'register.' ],function(){
            Route::get('/', [ 'as' => "index",'uses' => "AuthController@register"]);
            Route::post('/', [ 'uses' => "AuthController@store"]);
        });
	});
	Route::group(['prefix' => "transaction",'as' => "transaction."],function(){
		Route::get('payment/{code?}',['as' => "payment", 'uses' => "CustomerTransactionController@payment"]);
		Route::get('pay/{code?}',['as' => "pay", 'uses' => "CustomerTransactionController@pay"]);
	});
	
	Route::group(['middleware' => ["web","portal.auth"]], function(){
		Route::group(['prefix' => "transaction", 'as' => "transaction."], function () {
			Route::get('history',['as' => "history", 'uses' => "CustomerTransactionController@history"]);
			Route::get('ctc-history',['as' => "ctc_history", 'uses' => "CustomerTransactionController@ctc_history"]);
			Route::get('show/{id?}',['as' => "show", 'uses' => "CustomerTransactionController@show"]);
			Route::get('create',['as' => "create", 'uses' => "CustomerTransactionController@create"]);
			Route::any('success',['as' => "success", 'uses' => "DigipepController@success"]);
			Route::post('create',['uses' => "CustomerTransactionController@store"]);
			Route::post('other-store',['as' => "other_store", 'uses' => "CustomerTransactionController@other_store"]);
		});
		
	});

	Route::get('confirmation/{code}',['as' => "confirmation",'uses' => "MainController@confirmation"]);
	

});


Route::group(['as' => "web.",
		 'namespace' => "Web",
		],function() {
	
	Route::group(['prefix' => "digipep",'as' => "digipep."],function(){
		Route::any('success/{code}',['as' => "success",'uses' => "DigipepController@success"]);
		Route::any('cancel/{code}',['as' => "cancel",'uses' => "DigipepController@cancel"]);
		Route::any('failed/{code}',['as' => "failed",'uses' => "DigipepController@failed"]);
	});
});