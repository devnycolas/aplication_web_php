<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);

// Panel Routes
$routes->get('/produtos/listar', 'Produtos::listar', ['as' => 'produtos.listar']);
$routes->post('/produtos/cadastrar', 'Produtos::cadastrar', ['as' => 'produtos.cadastrar', 'filter' => 'csrf']);
$routes->delete('/produtos/excluir/(:any)', 'Produtos::excluir/$1', ['as' => 'produtos.excluir']);
$routes->put('/produtos/editar', 'Produtos::editar', ['as' => 'produtos.editar']);

// Login routes
$routes->get('/login', 'Login::index', ['as' => 'login']);
$routes->post('/login/autenticar', 'Login::autenticar', ['as' => 'login.autenticar', 'filter' => 'csrfThrottle']);
$routes->get('/login/sair', 'Login::sair', ['as' => 'login.sair']);

// Register Routes
$routes->get('/register', 'Register::index', ['as' => 'register']);
$routes->post('/register/autenticar', 'Register::autenticar', ['as' => 'register.autenticar', 'filter' => 'csrfThrottle']);

// Recover Password Routes
$routes->get('/forgot/password', 'Forgot::index', ['as' => 'forgot']);
$routes->post('/forgot', 'Forgot::store', ['as' => 'forgot.store', 'filter' => 'csrfThrottle']);
$routes->get('/reset/(:any)', 'Forgot::edit/$1', ['as' => 'forgot.edit']);
$routes->post('/forgot/update/(:any)', 'Forgot::update/$1', ['as' => 'forgot.update', 'filter' => 'csrfThrottle']);
