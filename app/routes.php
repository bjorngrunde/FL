<?php
# CSRF FILTERs
Route::when('/admin/*', 'csrf', ['post', 'delete', 'put']);
Route::when('/apply', 'csrf', ['post']);

########## ADMIN #########################
Route::group(['before' => 'checkRole'], function(){
    # Admin Area
    Route::get('/admin', 'AdminController@index');

    # Admin Ansökningar
    Route::get('/admin/applications', 'ApplicationsController@index');
    Route::get('/admin/applications/{id}','ApplicationsController@show');
    Route::get('/admin/applications/{id}/edit','ApplicationsController@edit');

    # Admin registrera användare
    Route::get('/admin/users', 'UsersController@index');
    Route::get('/admin/users/create', 'RegistrationController@create');
    Route::resource('registration', 'RegistrationController', ['only' => ['store', 'create']]);

    Route::get('/admin/users/{username}/edit/', 'UsersController@edit');
    Route::resource('users', 'UsersController', ['only' => ['update', 'destroy']]);

    #Skapa, redigera raids
    Route::get('/admin/flrs/create', 'RaidsController@create');
    Route::get('/admin/flrs/add', 'RaidsInstanceController@create');
    Route::get('/admin/flrs/index', 'RaidsController@adminIndex');
    Route::get('/admin/flrs/{id}/edit', 'RaidsController@edit');
    Route::get('/admin/flrs/instance', 'RaidsInstanceController@index');
    Route::get('/admin/flrs/instance/{id}/edit', 'RaidsInstanceController@edit');
    Route::get('/admin/create/{id}/raidgroup', 'RaidsController@createRaid');
    Route::post('/admin/save/raidgroup/{id}', ['as' => 'save.raidgroup', 'uses' => 'RaidsController@saveRaid']);
    Route::resource('flrs', 'RaidsController', ['only' => ['update', 'destroy', 'store']]);
    Route::resource('raids', 'RaidsInstanceController', ['only' => ['update' , 'store', 'destroy']]);

    #Nyheter, skapa redigera etc
    Route::get('/admin/posts/create', 'PostsController@create');
    Route::get('/admin/posts/index', 'PostsController@index');
    Route::get('/admin/posts/{id}/edit', 'PostsController@edit');
    Route::resource('posts', 'PostsController', ['only' => ['update', 'store', 'destroy']]);

    # Ta bort kommentarer
    Route::delete('/admin/comment/{id}/delete/', ['as' => 'delete-comment', 'uses' => 'CommentsController@deleteComment']);
});
######## ADMIN ENDS ###################

####### FRONT END ####################

Route::group(['before' => 'auth'], function(){

    # Dashboard
    Route::get('/dashboard', 'PagesController@index');

    #SÖK

    Route::get('/query', 'SearchController@query');
    Route::get('/searchresult', ['as' => 'searchresult', 'uses' => 'SearchController@searchResult']);

    # Profiler
    Route::get('/profile/{profile}', ['as' => 'profile','uses' => 'ProfilesController@show']);
    Route::get('/profile/{profile}/edit/', ['as' => 'profile.edit', 'uses' =>'ProfilesController@edit']);
    Route::resource('profiles', 'ProfilesController', ['only' => ['update']]);

    #flrs, front end
    Route::get('/flrs', 'RaidsController@index');
    Route::get('/flrs/show/{id}', 'RaidsController@show');
    Route::post('/flrs/signup/{id}', ['as' => 'signup', 'uses' => 'RaidsController@signup']);
    Route::post('flrs/change/{id}', ['as' => 'change.status', 'uses' => 'RaidsController@change']);

    #nyheter front-end
    Route::get('/news/post/{id}', 'PostsController@show');
    #FORUM
    Route::group(['prefix' => '/forum'], function(){
        Route::get('/', 'ForumsController@index');
        Route::get('/category/{id}', ['as' => 'forum-group', 'uses' => 'ForumsController@category']);
        Route::get('/thread/{id}', ['as' => 'forum-thread', 'uses' => 'ForumsController@thread']);
        Route::get('/new/thread/{id}', ['as' => 'newThread', 'uses' => 'ForumsController@newThread']);
        Route::get('/thread/edit/{id}', ['as' => 'thread.edit', 'uses' => 'ForumsController@editThread']);
        Route::get('/thread/{id}/delete', ['as' => 'forum-delete-comment', 'uses' => 'ForumsController@deleteThread']);



        Route::group(['before' => 'csrf'], function(){

            Route::post('/category/add', ['as' => 'forum-store-category', 'uses' => 'ForumsController@storeCategory']);
            Route::post('/group', ['as' => 'forum-store-group', 'uses' => 'ForumsController@storeGroup']);
            Route::post('/new/thread/save/{id}', ['as' => 'newThread.store', 'uses' => 'ForumsController@newThreadStore']);
            Route::post('/thread/update/{id}', ['as' => 'threadUpdate', 'uses' => 'ForumsController@updateThread']);
            Route::post('/thread/new/comment/{id}', ['as' => 'forum-store-comment', 'uses' => 'ForumsController@storeComment']);


        });
            Route::group(['before' => 'checkRole'], function(){
                Route::get('/group/{id}/delete', ['as'=> 'forum-delete-group', 'uses' => 'ForumsController@deleteGroup']);
                Route::get('/category/{id}/delete', ['as' => 'forum-delete-category', 'uses' => 'ForumsController@deleteCategory']);
                Route::get('/comment/{id}/delete', ['as' => 'forum-delete-comment', 'uses' => 'ForumsController@deleteComment']);
        });
    });
});
################# API #########################################
Route::group(['prefix' => '/api'], function(){

});
################################################################


# Login, logout & sessions
Route::get('/', ['before' =>'guest','as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('session', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

# Applys
Route::get('/apply', 'ApplicationsController@create')->before('guest');
Route::resource('application', 'ApplicationsController');

#Lösenordsåterställning
Route::controller('password', 'RemindersController');