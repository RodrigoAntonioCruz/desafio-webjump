<?php

use Steampixel\Route;
use App\Controllers\Products;
use App\Controllers\Dashboard;
use App\Controllers\Categories;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// Routes dashboard
Route::add('/', function() {
    (new Dashboard(new Request(), new Response()))->index();
}, 'get');


// Routes products
Route::add('/products', function() {
    (new Products(new Request(), new Response()))->index();
}, 'get');

Route::add('/products/list', function() {
    (new Products(new Request(), new Response()))->list();
}, 'get');

Route::add('/products/new', function() {
    (new Products(new Request(), new Response()))->new();
}, 'get');

Route::add('/products/add', function() {
    (new Products(new Request(), new Response()))->add();
}, 'post');

Route::add('/products/edit/([0-9\-]+)', function($sku) {
    (new Products(new Request(), new Response()))->edit($sku);
}, 'get');

Route::add('/products/edit', function() {
    (new Products(new Request(), new Response()))->update();
}, 'post');

Route::add('/products/delete/([0-9\-]+)', function($sku) {
    (new Products(new Request(), new Response()))->delete($sku);
}, 'get');


// Routes categories
Route::add('/categories', function() {
    (new Categories(new Request(), new Response()))->index();
}, 'get');

Route::add('/categories/list', function() {
    (new Categories(new Request(), new Response()))->list();
}, 'get');

Route::add('/categories/new', function() {
    (new Categories(new Request(), new Response()))->new();
}, 'get');

Route::add('/categories/add', function() {
    (new Categories(new Request(), new Response()))->add();
}, 'post');

Route::add('/categories/edit/([0-9\-]+)', function($codigo) {
    (new Categories(new Request(), new Response()))->edit($codigo);
}, 'get');

Route::add('/categories/edit', function() {
    (new Categories(new Request(), new Response()))->update();
}, 'post');

Route::add('/categories/delete/([0-9\-]+)', function($codigo) {
    (new Categories(new Request(), new Response()))->delete($codigo);
}, 'get');


// Routes not found
Route::pathNotFound(function($path) {
    $response = new Response();

    $pageContent = file_get_contents('../../resources/views/404.html');

    $response->setContent($pageContent);
    $response->setStatusCode(Response::HTTP_NOT_FOUND);
    $response->send();
});

Route::methodNotAllowed(function($path, $method) {
    $response = new RedirectResponse('/404');
    $response->send();
});