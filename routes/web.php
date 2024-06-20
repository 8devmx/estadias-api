<?php

use App\Http\Controllers\UserController;    
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

$router->get('/users', "UserController@getAllUsers");
$router->post('/users', "UserController@insertUser");
$router->get('/users/{id}', 'UserController@show');
$router->put('/users/{id}', 'UserController@updateUser');
$router->delete('/users/{id}', 'UserController@deleteUser');

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