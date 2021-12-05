<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

$routes->get('listar', 'Usuarios::index');

$routes->get('login', 'Usuarios::login');
$routes->get('crear', 'Usuarios::crear');
$routes->get('venderEstadiaAdmin', 'Usuarios::venderEstadiaAdmin');
$routes->get('consultarPrecio', 'Usuarios::consultarPrecio');
$routes->get('venderEstadia', 'Vendedor::venderEstadia');
$routes->get('estacionarVehiculo', 'Usuarios::estacionarVehiculo');
$routes->get('consultarPrecio', 'Vendedor::consultarPrecio');
$routes->get('homeCliente', 'Usuarios::homeCliente');
$routes->get('homeInspector', 'Usuarios::homeInspector');
$routes->get('homeVendedor', 'Usuarios::homeVendedor');
$routes->get('borrar/(:num)', 'Usuarios::borrar/$1');
$routes->get('editar/(:num)', 'Usuarios::editar/$1');
$routes->get('resetPass/(:num)', 'Usuarios::resetPass/$1');
$routes->get('consultaEstacionamiento', 'Inspectores::listarEstacionamiento');
$routes->get('consultaEstacionamientoAdmin', 'Usuarios::listarEstacionamiento');
$routes->get('altaVehiculo', 'Usuarios::altaVehiculo');
$routes->get('ingresarSaldo', 'Usuarios::ingresarSaldo');
$routes->get('miWallet', 'Usuarios::miWallet');
$routes->get('tarjetaCredito', 'Usuarios::tarjetaCredito');
$routes->get('misEstadiasPendientes', 'Usuarios::misEstadiasPendientes');
$routes->get('pagarEstadia/(:num)', 'Usuarios::pagarEstadia/$1');
$routes->get('listadoZonaAdmin','Usuarios::listadoZonaAdmin');

$routes->get('desestacionarV', 'Usuarios::desestacionarV');
$routes->get('desestacionarVehiculo/(:num)', 'Usuarios::desestacionarVehiculo/$1');
$routes->get('estacionarIndefinido/(:num)', 'Usuarios::estacionarIndefinido/$1');
$routes->get('estacionarPendiente/(:num)', 'Usuarios::estacionarPendiente/$1');
$routes->get('editarPerfil/(:num)', 'Usuarios::editarPerfil/$1');
$routes->get('altaInfraccion', 'Inspectores::altaInfraccion');
$routes->get('listarMisVentas', 'usuarios::listarMisVentas');
$routes->post('estacionarNuevoPendiente', 'Usuarios::estacionarNuevoPendiente');
$routes->post('venderEstadiaIndefinido', 'Usuarios::venderEstadiaIndefinido');
$routes->post('nuevaInfraccion', 'Inspectores::nuevaInfraccion');

$routes->post('guardar', 'Usuarios::guardar');
$routes->post('actualizar', 'Usuarios::actualizar');
$routes->post('altaNuevoVehiculo', 'Usuarios::altaNuevoVehiculo');
$routes->post('venderNuevaEstadiaAdmin', 'Usuarios::venderEstadiaAdmin');
$routes->post('venderNuevaEstadia', 'Vendedor::venderNuevaEstadia');
$routes->get('editarZona/(:num)', 'Usuarios::editarZona/$1');
$routes->post('actualizarZona','Usuarios::actualizarZona');

$routes->post('comprarNuevaEstadia', 'Usuarios::estacionarGuardaVehiculo');
$routes->post('actualizarPerfil', 'Usuarios::actualizarPerfil');
$routes->post('cargarSaldo', 'Usuarios::cargarSaldo');
$routes->post('creditCardEdit', 'Usuarios::creditCardEdit');

$routes->get('precio', 'EstadiaController::precio');
