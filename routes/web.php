<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\landingsController;
use App\Http\Controllers\LeadController;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/users', "UserController@getAllusers");
$router->post('/users', "UserController@insertuser");
$router->get('/users/{id}', 'UserController@showuser');
$router->put('/users/{id}', 'UserController@updateUser');
$router->delete('/users/{id}', 'UserController@deleteUser');

$router->get('/landings', "landingsController@getAlllandings");
$router->post('/landings', "landingsController@insertlandings");
$router->get('/landings/{id}', 'landingsController@showlandings');
$router->put('/landings/{id}', 'landingsController@updatelandings');
$router->delete('/landings/{id}', 'landingsController@deletelandings');


$router->get('/leads', "LeadController@getAllLeads");
$router->get('/leads/{id}', "LeadController@showLeads");
$router->post('/leads', "LeadController@insertLeads");
$router->delete('/leads/{id}', 'LeadController@deleteLeads');
$router->put('/leads/{id}', 'LeadController@updateLeads');

$router->get('/company', "CompanyController@getAllCompany");
$router->post('/company', "CompanyController@insertCompany");
$router->get('/company/{id}', 'CompanyController@show');
$router->put('/company/{id}', 'CompanyController@updateCompany');
$router->delete('/company/{id}', 'CompanyController@deleteCompany');