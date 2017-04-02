<?php

// unauthenticated
$app->group([
    'prefix' => '/v1',
], function () use ($app) {
    // login
    $app->post('/token', [
       'uses' => 'AuthController@store',
    ]);

    // accept invite
    $app->get('/invites/{token}', [
        'uses' => 'InviteController@get',
    ]);

    $app->post('/invites/{token}', [
        'uses' => 'InviteController@update'
    ]);
});

// normal users
$app->group([
    'prefix' => '/v1',
    'middleware' => 'auth',
], function () use ($app) {
    // user
    $app->get('/users/me', [
        'uses' => 'UserController@get'
    ]);

    // behaviour
    $app->get('behaviour-categories', [
        'uses' => 'BehaviourCategoryController@index',
    ]);

    $app->get('/behaviour', [
        'uses' => 'BehaviourController@index',
    ]);

    // observations
    $app->get('observations', [
       'uses' => 'ObservationController@index',
    ]);

    // students
    $app->get('/students', [
        'uses' => 'StudentController@index',
    ]);

    // student observations
    $app->get('/students/{id}/observations', [
        'uses' => 'StudentObservationController@index',
    ]);
    $app->post('/students/{id}/observations', [
        'uses' => 'StudentObservationController@store',
    ]);

    // reports
    $app->get('/reports/{type}', [
        'uses' => 'ReportController@index',
    ]);
});

// editors
$app->group([
    'prefix' => '/v1',
    'middleware' => [ 'auth', 'role:editor' ],
], function () use ($app) {
    // editor behaviour categories
    $app->post('/behaviour-categories', [
        'uses' => 'BehaviourCategoryController@store',
    ]);

    $app->put('/behaviour-categories/{id}', [
        'uses' => 'BehaviourCategoryController@update',
    ]);

    $app->delete('/behaviour-categories/{id}', [
        'uses' => 'BehaviourCategoryController@destroy',
    ]);


    // editor behaviour
    $app->post('/behaviour', [
        'uses' => 'BehaviourController@store',
    ]);

    $app->put('/behaviour/{id}', [
        'uses' => 'BehaviourController@update',
    ]);

    $app->delete('/behaviour/{id}', [
        'uses' => 'BehaviourController@destroy',
    ]);
});

// admins
$app->group([
    'prefix' => '/v1',
    'middleware' => [ 'auth', 'role:admin' ],
], function () use ($app) {
    // admin students
    $app->post('/students/reconcile', [
        'uses' => 'StudentController@reconcile',
    ]);

    // invites
    $app->get('/invites-unaccepted', [
        'uses' => 'InviteController@index',
    ]);

    $app->post('/invites', [
        'uses' => 'InviteController@store',
    ]);
});