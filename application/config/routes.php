<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/*

| -------------------------------------------------------------------------

| URI ROUTING

| -------------------------------------------------------------------------

| This file lets you re-map URI requests to specific controller functions.

|

| Typically there is a one-to-one relationship between a URL string

| and its corresponding controller class/method. The segments in a

| URL normally follow this pattern:

|

|	example.com/class/method/id/

|

| In some instances, however, you may want to remap this relationship

| so that a different class/function is called than the one

| corresponding to the URL.

|

| Please see the user guide for complete details:

|

|	https://codeigniter.com/user_guide/general/routing.html

|

| -------------------------------------------------------------------------

| RESERVED ROUTES

| -------------------------------------------------------------------------

|

| There are three reserved routes:

|

|	$route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|	$route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router which controller/method to use if those

| provided in the URL cannot be matched to a valid route.

|

|	$route['translate_uri_dashes'] = FALSE;

|

| This is not exactly a route, but allows you to automatically route

| controller and method names that contain dashes. '-' isn't a valid

| class or method name character, so it requires translation.

| When you set this option to TRUE, it will replace ALL dashes in the

| controller and method URI segments.

|

| Examples:	my-controller/index	-> my_controller/index

|		my-controller/my-method	-> my_controller/my_method

*/

$route['default_controller'] = 'Dashboard/home';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;

$route['index'] = 'Dashboard/home';

$route['ach'] 				= 'Dashboard/achievment';

$route['api/login']['POST'] = 'Login/LoginMobile';

$route['api/user(:num)/(:num)']['GET']  = 'Api/getUser/$1/$2';

$route['api/user(:any)']['PUT']  = 'Api/UpdateUser/$1';

$route['api/jualproduk']['POST'] = 'Api/InputJualProduk';

$route['api/inputAbsen']['POST'] = 'Api/inputAbsenStatus';

$route['api/inputContact']['POST'] = 'Api/inputContactForm';

$route['api/inputConsumerPromo']['POST'] = 'Api/inputConsumerPromo';

$route['api/inputOutOfStock']['POST'] = 'Api/inputOutOfStock';

$route['api/filterReport']['POST'] = 'Api/filterReport';

$route['topSku'] 				= 'Dashboard/reportTopSKu';

$route['topBA'] 				= 'Dashboard/reportTopBA';

$route['mail'] 				= 'Api/mail';

$route['topCabang'] 				= 'Dashboard/reportTopCabang';

$route['topAccount'] 				= 'Dashboard/reportTopAccount';

/*USER*/

	$route['users'] = 'Dashboard/dataUser';

	$route['users/changeCabang'] = 'Api/ChangeCabang';

	$route['users/add']['GET'] = 'Dashboard/AdddataUser';

	$route['users/add']['POST'] = 'Dashboard/AdddataUser';

	$route['user/edit']['POST'] = 'Dashboard/UpdateEditUser';

	$route['users/edit/(:num)']['GET'] = 'Dashboard/EditdataUser';

	$route['users/delete/(:num)']['GET'] = 'Dashboard/deleteDataUser';

	$route['users/addAssignStore/(:num)']['GET'] ='Dashboard/assignStore/$1';

	$route['users/addAssignStore/(:num)']['POST'] ='Dashboard/addAssignStore/$1';

	$route['users/targetUser/(:num)/(:num)/(:num)/(:num)']['GET'] ='Dashboard/TargetUser/$1/$2/$3';
	$route['users/targetUser/(:num)/(:num)/(:num)/(:num)']['POST'] ='Dashboard/TargetUser/$1/$2/$3';

	$route['users/targetUser/(:num)/(:num)/null/null']['GET'] ='Dashboard/TargetUser/$1/$2/$3/$4';
	$route['users/targetUser/(:num)/(:num)/null/null']['POST'] ='Dashboard/TargetUser/$1/$2/$3/$4';

	$route['users/targetUser/(:num)/(:num)/(:num)/null']['GET'] ='Dashboard/TargetUser/$1/$2/$3/$4';
	$route['users/targetUser']['POST'] ='Dashboard/TargetUser';

	$route['aktifitas-user'] 				= 'Dashboard/aktifitasUser';

/*Account*/
	

	$route['getAccountToko'] = 'Dashboard/getTokoAccount';

	$route['account'] = 'Dashboard/dataAccount';

	$route['account/add']['GET'] = 'Dashboard/AdddataAccount';

	$route['account/add']['POST'] = 'Dashboard/insertAccount';

	$route['account/edit/(:num)']['GET'] = 'Dashboard/EditdataAccount';

	$route['account/edit']['POST'] = 'Dashboard/EditdataAccount';

	$route['account/delete/(:num)']['GET'] = 'Dashboard/DeleteAccount';

/*SKU*/

	$route['sku'] = 'Dashboard/dataSku';

	$route['sku/add']['GET'] = 'Dashboard/AdddataSku';

	$route['sku/delete/(:num)']['GET'] = 'Dashboard/deleteDataSku';

	$route['sku/add']['POST'] = 'Dashboard/insertDataSku';

	$route['sku/edit']['POST'] = 'Dashboard/updateDataSku';

	$route['sku/edit/(:num)']['GET'] = 'Dashboard/EditdataSku';



/*toko*/

	$route['test'] = 'Dashboard/testData';

	$route['test2'] = 'Dashboard/testData2';

	$route['toko'] = 'Dashboard/dataToko';

	$route['toko/add']['GET'] = 'Dashboard/AdddataToko';

	$route['toko/add']['POST']= 'Dashboard/InsertAdddataToko';

	$route['tokoAddTarget/add']['POST']= 'Dashboard/InsertTokoTarget';

	$route['toko/edit/(:num)']['GET']= 'Dashboard/editDataToko/$1';

	$route['toko/edit/(:num)']['POST']= 'Dashboard/updateDataToko/$1';

	$route['toko/delete/(:num)']['GET']= 'Dashboard/deleteDataToko/$1';

	$route['toko/target/(:num)']['GET']= 'Dashboard/tokoTarget/$1';

	$route['toko/editTarget/(:num)']['GET'] = 'Dashboard/editTargetToko';

	$route['toko/updateTarget'] = 'Dashboard/targetUpdate';

	$route['sku/price/(:num)']['GET']= 'Dashboard/formPrice/$1';
	

//CABANG

	$route['cabang']				= 'Dashboard/dataCabang';

	$route['cabang/add']['GET'] 			= 'Dashboard/addDataCabang';

	$route['cabang/delete/(:num)']['GET'] 	= 'Dashboard/deleteDataCabang';

	$route['cabang/add']['POST'] 			= 'Dashboard/insertDataCabang';

	$route['cabang/edit/(:num)']['POST'] 	= 'Dashboard/updateDataCabang';

	$route['cabang/edit/(:num)']['GET'] 	= 'Dashboard/editDataCabang';



//KOTA

	$route['kota'] 						= 'Dashboard/dataKota';

	$route['kota/add']['GET'] 			= 'Dashboard/addDataKota';

	$route['kota/delete/(:num)']['GET'] = 'Dashboard/deleteDataKota';

	$route['kota/add']['POST'] 			= 'Dashboard/insertDataKota';

	$route['kota/edit']['POST'] 		= 'Dashboard/updateDataKota';

	$route['kota/edit/(:num)']['GET'] 	= 'Dashboard/editDataKota';



/*WEB*/

	$route['absensi'] 				= 'Dashboard/absensi';

	$route['absensi/izin']			= 'Dashboard/absensiizin';

	$route['kategori'] 				= 'Dashboard/kategori';

	$route['kategori/add'] 			= 'Dashboard/kategoriadd';

	$route['oos'] 					= 'Dashboard/reportOutOfStock';

	$route['report'] 				= 'Dashboard/reportSku';

	$route['report/skuExcel'] = 'Dashboard/skuExcel';

	$route['report/skuReport']['POST']= 'Dashboard/insertReportSku';

	$route['detailcontact'] 	= 'Dashboard/reportdetailcontact';

	$route['totalcontact'] 	= 'Dashboard/reporttotalcontact';

	$route['reportpromo'] 			= 'Dashboard/reportpromo';

	$route['report/absensiReport'] 			= 'Dashboard/absensiReport';

	$route['report/achievementReport'] 			= 'Dashboard/achievement';



/*Keterangan OOS*/

	$route['keterangan_oos'] 				= 'Dashboard/keterangan_oos';

	$route['kategori_segmen'] 				= 'Dashboard/kategori_segmen';

	$route['keterangan/form_keterangan'] 				= 'Dashboard/form_keterangan';

	$route['keterangan/form_keterangan/(:num)'] 				= 'Dashboard/form_keterangan';

	$route['keterangan/form_keterangan/delete/(:num)'] 				= 'Dashboard/form_keterangan';



/*LOGOUT*/

	$route['logout'] = 'Dashboard/keluar';

	$route['getToko'] = 'Dashboard/getTokoo';

	$route['getTokoTarget'] = 'Dashboard/getTargetToko';


	$route['CountTotalContact'] = 'Dashboard/reporttotalcontact';

	$route['updatetarget'] = 'Dashboard/updatetargetToko';


/*END WEB*/

