<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Define routes

$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');

$routes->get('/users', 'OfficeUser::index', ['filter' => 'admin']);
$routes->post('/users/data/(:num)', 'Officeuser::data/$1', ['filter' => 'admin']);
$routes->post('/users/baru', 'OfficeUser::insert', ['filter' => 'admin']);
$routes->post('/users/(:num)', 'OfficeUser::update/$1', ['filter' => 'admin']);
$routes->delete('/users/(:num)', 'OfficeUser::delete/$1', ['filter' => 'admin']);
$routes->post('/users/pass', 'OfficeUser::pass', ['filter' => 'admin']);
$routes->post('/users/sql/', 'OfficeUser::userSql', ['filter' => 'admin']);
$routes->get('/users/sql/(:any)', 'OfficeUser::collumns/$1', ['filter' => 'admin']);

$routes->get('/pengurus', 'OfficePengurus::index', ['filter' => 'admin']);
$routes->get('/pengurus/(:num)', 'OfficePengurus::detail/$1', ['filter' => 'admin']);
$routes->post('/pengurus/(:num)', 'OfficePengurus::update/$1', ['filter' => 'admin']);
$routes->get('/pengurus/baru', 'OfficePengurus::detail/', ['filter' => 'admin']);
$routes->post('/pengurus/baru', 'OfficePengurus::insert/', ['filter' => 'admin']);
// $routes->delete('/pengurus/(:num)', 'OfficePengurus::delete/$1', ['filter' => 'admin']);
$routes->post('/pengurus/hapus/(:num)', 'OfficePengurus::delete/$1', ['filter' => 'admin']);
$routes->get('/pengurus/ceklis/(:num)', 'OfficePengurus::ceklis/$1', ['filter' => 'admin']);
$routes->get('/pengurus/pos/(:num)/(:any)', 'OfficePengurus::add_tunj/$1/$2', ['filter' => 'admin']);
$routes->post('/pengurus/import', 'OfficePengurus::import', ['filter' => 'admin']);
$routes->get('/pengurus/export', 'OfficePengurus::export', ['filter' => 'admin']);

$routes->get('/kompetensi', 'OfficeKompetensi::index', ['filter' => 'admin']);
$routes->post('/kompetensi/baru', 'OfficeKompetensi::insert', ['filter' => 'admin']);
$routes->post('/kompetensi/(:num)', 'OfficeKompetensi::update/$1', ['filter' => 'admin']);
// $routes->delete('/kompetensi/(:num)', 'OfficeKompetensi::delete/$1', ['filter' => 'admin']);
$routes->post('/kompetensi/hapus/(:num)', 'OfficeKompetensi::delete/$1', ['filter' => 'admin']);
$routes->get('/kompetensi/santri/(:num)', 'OfficeKompetensi::santri/$1', ['filter' => 'admin']);
$routes->post('/kompetensi/data/(:num)', 'OfficeKompetensi::data/$1', ['filter' => 'admin']);

$routes->post('/absensi/baru', 'OfficeAbsensi::insert', ['filter' => 'admin']);
$routes->post('/absensi/(:num)', 'OfficeAbsensi::update/$1', ['filter' => 'admin']);
$routes->get('/absensi/santri/(:num)', 'OfficeAbsensi::santri/$1', ['filter' => 'admin']);
$routes->post('/absensi/data/(:num)', 'OfficeAbsensi::data/$1', ['filter' => 'admin']);
$routes->get('/absensi/ceklis/(:num)', 'OfficeAbsensi::ceklis/$1', ['filter' => 'admin']);
$routes->post('/absensi/import', 'OfficeAbsensi::import', ['filter' => 'admin']);
$routes->get('/absensi/export', 'OfficeAbsensi::export', ['filter' => 'admin']);
$routes->get('/absensi/(:any)', 'OfficeAbsensi::index/$1', ['filter' => 'admin']);
$routes->get('/absensi', 'OfficeAbsensi::index', ['filter' => 'admin']);
// $routes->delete('/absensi/(:num)/(:any)', 'OfficeAbsensi::delete/$1/$2', ['filter' => 'admin']);
$routes->post('/absensi/hapus/(:num)/(:any)', 'OfficeAbsensi::delete/$1/$2', ['filter' => 'admin']);

$routes->get('/skim', 'RemunSkim::index', ['filter' => 'admin']);
$routes->post('/skim/baru', 'RemunSkim::insert', ['filter' => 'admin']);
$routes->post('/skim/(:num)', 'RemunSkim::update/$1', ['filter' => 'admin']);
$routes->delete('/skim/(:num)', 'RemunSkim::delete/$1', ['filter' => 'admin']);
$routes->post('/skim/data/(:num)', 'RemunSkim::data/$1', ['filter' => 'admin']);
$routes->get('/skim/ceklis/(:num)', 'RemunSkim::ceklis/$1', ['filter' => 'admin']);

$routes->get('/tunjangan', 'RemunTunjangan::index', ['filter' => 'admin']);
$routes->post('/tunjangan/baru', 'RemunTunjangan::insert', ['filter' => 'admin']);
$routes->post('/tunjangan/(:num)', 'RemunTunjangan::update/$1', ['filter' => 'admin']);
$routes->delete('/tunjangan/(:num)', 'RemunTunjangan::delete/$1', ['filter' => 'admin']);
$routes->get('/tunjangan/santri/(:num)', 'RemunTunjangan::santri/$1', ['filter' => 'admin']);
$routes->post('/tunjangan/data/(:num)', 'RemunTunjangan::data/$1', ['filter' => 'admin']);
$routes->get('/tunjangan/ceklis/(:num)', 'RemunTunjangan::ceklis/$1', ['filter' => 'admin']);

$routes->get('/potongan', 'RemunPotongan::index', ['filter' => 'admin']);
$routes->post('/potongan/baru', 'RemunPotongan::insert', ['filter' => 'admin']);
$routes->post('/potongan/(:num)', 'RemunPotongan::update/$1', ['filter' => 'admin']);
$routes->delete('/potongan/(:num)', 'RemunPotongan::delete/$1', ['filter' => 'admin']);
$routes->get('/potongan/santri/(:num)', 'RemunPotongan::santri/$1', ['filter' => 'admin']);
$routes->post('/potongan/data/(:num)', 'RemunPotongan::data/$1', ['filter' => 'admin']);
$routes->get('/potongan/ceklis/(:num)', 'RemunPotongan::ceklis/$1', ['filter' => 'admin']);

$routes->post('/proses/simpan/(:any)/(:any)', 'RemunProses::simpan/$1/$2', ['filter' => 'admin']);
$routes->post('/proses/data/(:any)/(:any)', 'RemunProses::data/$1/$2', ['filter' => 'admin']);
$routes->get('/proses/excel/(:any)', 'RemunProses::export/$1', ['filter' => 'admin']);
$routes->get('/proses/draft/(:any)', 'RemunProses::draft/$1', ['filter' => 'admin']);
$routes->get('/proses/rekap/(:any)', 'RemunProses::rekap/$1', ['filter' => 'admin']);
$routes->get('/proses/slip/(:any)', 'RemunProses::slip/$1', ['filter' => 'admin']);
$routes->get('/proses/(:any)', 'RemunProses::index/$1', ['filter' => 'admin']);

$routes->set404Override(function () {
    return view('errors/404');
});
