<?php

require_once __DIR__ . './../includes/app.php';



use MCV\Router;

use Controllers\PaginaControllers;
use Controllers\AdmblogControllers;
use Controllers\CuentasControllers;
use Controllers\BlogControllers;


$router = new Router();

/* administrar las pestañas */
$router->get('/', [PaginaControllers::class, 'index']);
$router->post('/', [PaginaControllers::class, 'index']);
$router->get('/paginaDeControl', [PaginaControllers::class, 'paginaDeControl']);
$router->post('/paginaDeControl', [PaginaControllers::class, 'eliminar']);


/* administrar los Blog */
$router->get('/blog', [AdmblogControllers::class, 'blog']);
$router->get('/blogs', [AdmblogControllers::class, 'blogs']);
/* controlarBlog*/
$router->get('/crear', [BlogControllers::class, 'crear']);
$router->post('/crear', [BlogControllers::class, 'crear']);
$router->get('/actualizar', [BlogControllers::class, 'actualizar']);
$router->post('/actualizar', [BlogControllers::class, 'actualizar']);


/* administrar las cuaentas */
$router->get('/logout', [CuentasControllers::class, 'logout']);
$router->get('/registrar', [CuentasControllers::class, 'registrar']);
$router->post('/registrar', [CuentasControllers::class, 'registrar']);
$router->get('/admin', [CuentasControllers::class, 'admin']);
$router->post('/admin', [CuentasControllers::class, 'admin']);
//debuguear('hola');



$router->comprobarRutas();









