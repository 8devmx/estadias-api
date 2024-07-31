<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\landingsController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\SequimientosController;
use App\Models\Sequimiento;
use Doctrine\DBAL\Driver\Middleware;
use Illuminate\Support\Facades\Route;

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
$router->post('/auth/login',[
    'uses' => 'AuthController@authenticate'
]);

$router->group(
    ['middleware' => 'jwt.auth'],
    function () use ($router){

                            // RUTAS PROTEGIDAS

        // leads
        $router->get('/leads', "LeadController@getAllLeads");
        $router->get('/leads/{id}', "LeadController@showLeads");
        $router->post('/leads', "LeadController@insertLeads");
        $router->delete('/leads/{id}', 'LeadController@deleteLeads');
        $router->put('/leads/{id}', 'LeadController@updateLeads');

        // leads_historial
        $router->get('/leads_historial', "leadHistorialController@getAllLeadHistorial");
        $router->get('/leads_historial/{id}', "leadHistorialController@showLeadHistorial");
        $router->post('/leads_historial', "leadHistorialController@insertLeadHistorial");

        // Candidatos
        $router->get('/candidates', "CandidateController@getAllCandidates");
        $router->post('/candidates', "CandidateController@insertCandidates");
        $router->get('/candidates/{id}', 'CandidateController@showCandidates');
        $router->put('/candidates/{id}', 'CandidateController@updateCandidates');
        $router->delete('/candidates/{id}', 'CandidateController@deleteCandidates');

        // company
        $router->get('/company', "CompanyController@getAllCompany");
        $router->post('/company', "CompanyController@insertCompany");
        $router->get('/company/{id}', 'CompanyController@show');
        $router->put('/company/{id}', 'CompanyController@updateCompany');
        $router->delete('/company/{id}', 'CompanyController@deleteCompany');

    }
); 

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'AuthController@login');

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
$router->get('/landing/slug/{slug}', 'landingsController@showlandingsBySlug');

// // company
// $router->get('/company', "CompanyController@getAllCompany");
// $router->post('/company', "CompanyController@insertCompany");
// $router->get('/company/{id}', 'CompanyController@show');
// $router->put('/company/{id}', 'CompanyController@updateCompany');
// $router->delete('/company/{id}', 'CompanyController@deleteCompany');

$router->get('/vacancies', "VacancieController@getAllVacancies");
$router->post('/vacancies', "VacancieController@insertVacancies");
$router->get('/vacancies/{id}', 'VacancieController@showVacancies');
$router->put('/vacancies/{id}', 'VacancieController@updateVacancies');
$router->delete('/vacancies/{id}', 'VacancieController@deleteVacancies');

// Candidatos
// $router->get('/candidates', "CandidateController@getAllCandidates");
// $router->post('/candidates', "CandidateController@insertCandidates");
// $router->get('/candidates/{id}', 'CandidateController@showCandidates');
// $router->put('/candidates/{id}', 'CandidateController@updateCandidates');
// $router->delete('/candidates/{id}', 'CandidateController@deleteCandidates');

// Sequimientos
$router->get('/sequimientos', "SequimientosController@getAllSequimientos");
$router->post('/sequimientos', "SequimientosController@insertSequimientos");
$router->get('/sequimientos/{id}', 'SequimientosController@showSequimientos');
$router->get('/search-sequimientos','SequimientosController@searchByNameClientId');

// staus
$router->get('/status', "StatusController@getAllStatus");
$router->get('/status/{id}', 'StatusController@showStatus');

