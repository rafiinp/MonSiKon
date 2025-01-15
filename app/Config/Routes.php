<?php

use CodeIgniter\Router\RouteCollection;

$routes->setAutoRoute(true);

/**
 * @var RouteCollection $routes
 */

 $routes->group('', ['filter' => 'isLoggedIn'], function($routes) {
    // Define the main user routes
    $routes->get('user', 'User::index');
    $routes->get('user/new', 'User::new');
    $routes->post('user/create', 'User::create');
    $routes->get('user/edit/(:num)', 'User::edit/$1');
    $routes->post('user/update/(:num)', 'User::update/$1');
    $routes->get('user/delete/(:num)', 'User::delete/$1');  // If needed for deleting users

    // You can also include other necessary routes
});


$routes->presenter('container', ['filter' => 'isLoggedIn']);
$routes->get('containerTabel', 'Container::index', ['filter' => 'isLoggedIn']);



$routes->presenter('inspection', ['filter' => 'isLoggedIn']);
$routes->get('inspectionTabel', 'Inspection::index', ['filter' => 'isLoggedIn']);



$routes->addRedirect('/', 'home');



// Login User
$routes->get('login', 'Auth::login');

$routes->group('', ['filter' => 'isLoggedIn'], function($routes) {
   
    // Container Management
    $routes->group('container', function($routes) {
        // List view
        $routes->get('/', 'Container::index');
        
        // Create operations
        $routes->get('new', 'Container::new');
        $routes->post('create', 'Container::create');
        
        // Read operation
        $routes->get('view/(:num)', 'Container::view/$1');
        
        // Update operations
        $routes->get('edit/(:num)', 'Container::edit/$1');
        $routes->post('update/(:num)', 'Container::update/$1');
        
        // Delete operation
        $routes->get('delete/(:num)', 'Container::delete/$1');
        
        // Status updates
        $routes->post('status/(:num)', 'Container::updateStatus/$1');
    });

    // Admin inspection routes
    $routes->get('inspections', 'Inspection::index');
    $routes->get('inspection/schedule', 'Inspection::schedule');
    $routes->post('inspection/create-schedule', 'Inspection::create');


    // Surveyor inspection routes
    $routes->get('surveyor/dashboard', 'Inspection::surveyorDashboard');
    $routes->get('surveyor/perform/(:num)', 'Inspection::perform/$1');
    $routes->post('surveyor/submit/(:num)', 'Inspection::update/$1');
    $routes->get('surveyor/inspections', 'Inspection::inspectionsurveyorlist');

    $routes->get('/company', 'CompanyController::index');
$routes->get('/company/create', 'CompanyController::create');
$routes->post('/company/store', 'CompanyController::store');
$routes->get('/company/edit/(:num)', 'CompanyController::edit/$1');
$routes->post('/company/update/(:num)', 'CompanyController::update/$1');
$routes->get('/company/delete/(:num)', 'CompanyController::delete/$1');


    
    // OCR API endpoint
    $routes->post('inspection/scan', 'Inspection::scan');

    $routes->get('pdf', 'Pdf::index');
$routes->get('pdf/downloadPdf', 'Pdf::downloadPdf');
$routes->get('pdf/downloadPdf/(:num)', 'Pdf::downloadPdf/$1');
});


