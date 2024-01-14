<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);


$routes->get('/produtos/listar', 'Produtos::listar', ['as' => 'produtos.listar']);
$routes->post('/produtos/cadastrar', 'Produtos::cadastrar', ['as' => 'produtos.cadastrar']);
$routes->delete('/produtos/excluir/(:any)', 'Produtos::excluir/$1', ['as' => 'produtos.excluir']);
$routes->put('/produtos/editar', 'Produtos::editar', ['as' => 'produtos.editar']);


$routes->get('/login', 'Login::index', ['as' => 'login']);
$routes->post('/login/autenticar', 'Login::autenticar', ['as' => 'login.autenticar']);
$routes->get('/login/sair', 'Login::sair', ['as' => 'login.sair']);
$routes->get('/register', 'Register::index', ['as' => 'register']);
$routes->post('/register/autenticar', 'Register::autenticar', ['as' => 'register.autenticar']);

