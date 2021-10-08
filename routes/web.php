<?php

 /*
 |--------------------------------------------------------------------------
 | Файл маршрутизации
 |--------------------------------------------------------------------------
 */

namespace SDFramework\Routes;
$route->before('GET', '/.*', function() {
  //
 });
$route->get('/', function() {
  echo \SDFramework\Controllers\DefaultController::welcome();
});
/*------------------------------------------------------*/

$route->get('/api/enter', function() {
  echo \SDFramework\Controllers\DefaultController::enter();
});

$route->get('/api/get:(\w+)/from:(\w+)', function($filed, $table) {
  echo \SDFramework\Controllers\DefaultController::get_method($filed, $table);
});


$route->post('/api/registration', function() {
  echo \SDFramework\Controllers\DefaultController::registration();
});



?>