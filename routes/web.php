<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZenixadminController;
use App\Http\Controllers\MovementsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HousesController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');

    Route::get('logout', 'App\Http\Controllers\AuthController@logout');
});
Route::controller(ZenixadminController::class)->group(function () {

    //Route::get('/',             'dashboard_1')->middleware('auth');
    //Route::get('/index',        'dashboard_1');
    Route::get('/index-2',      'dashboard_2');
    Route::get('/coin-details', 'coin_details');
    Route::get('/portofolio',   'portofolio');
    Route::get('/market-capital', 'market_capital');
    Route::get('/tranasactions', 'tranasactions')->middleware('auth');
    Route::get('/my-wallets',   'my_wallets');
    Route::get('/app-profile',  'app_profile');
    Route::match(['get','post'],'/post-details', 'post_details');
    Route::get('/page-chat',    'page_chat');
    Route::get('/project-list', 'project_list');
    Route::get('/project-card', 'project_card');
    Route::get('/user-list-datatable', 'user_list_datatable');
    Route::get('/user-list-column', 'user_list_column');
    Route::get('/contact-list', 'contact_list');
    Route::get('/contact-card', 'contact_card');
    Route::get('/email-compose', 'email_compose');
    Route::get('/email-inbox',  'email_inbox');
    Route::get('/email-read',   'email_read');
    Route::get('/app-calender', 'app_calender');
    Route::get('/ecom-checkout','ecom_checkout');
    Route::get('/ecom-customers', 'ecom_customers');
    Route::get('/ecom-invoice', 'ecom_invoice');
    Route::get('/ecom-product-detail', 'ecom_product_detail');
    Route::get('/ecom-product-grid', 'ecom_product_grid');
    Route::get('/ecom-product-list', 'ecom_product_list');
    Route::get('/ecom-product-order', 'ecom_product_order');
    Route::get('/chart-chartist', 'chart_chartist');
    Route::get('/chart-chartjs','chart_chartjs');
    Route::get('/chart-flot',   'chart_flot');
    Route::get('/chart-morris', 'chart_morris');
    Route::get('/chart-peity',  'chart_peity');
    Route::get('/chart-sparkline', 'chart_sparkline');
    Route::get('/ui-accordion', 'ui_accordion');
    Route::get('/ui-alert',     'ui_alert');
    Route::get('/ui-badge',     'ui_badge');
    Route::get('/ui-button',    'ui_button');
    Route::get('/ui-button-group', 'ui_button_group');
    Route::get('/ui-card',      'ui_card');
    Route::get('/ui-carousel',  'ui_carousel');
    Route::get('/ui-dropdown',  'ui_dropdown');
    Route::get('/ui-grid',      'ui_grid');
    Route::get('/ui-list-group', 'ui_list_group');
    Route::get('/ui-media-object', 'ui_media_object');
    Route::get('/ui-modal',     'ui_modal');
    Route::get('/ui-pagination', 'ui_pagination');
    Route::get('/ui-popover',   'ui_popover');
    Route::get('/ui-progressbar', 'ui_progressbar');
    Route::get('/ui-tab',       'ui_tab');
    Route::get('/ui-typography', 'ui_typography');
    Route::get('/uc-nestable',  'uc_nestable');
    Route::get('/uc-lightgallery', 'uc_lightgallery');
    Route::get('/uc-noui-slider', 'uc_noui_slider');
    Route::get('/uc-select2',   'uc_select2');
    Route::get('/uc-sweetalert', 'uc_sweetalert');
    Route::get('/uc-toastr',    'uc_toastr');
    Route::get('/map-jqvmap',   'map_jqvmap');
    Route::get('/widget-basic', 'widget_basic');
    Route::get('/form-editor-summernote', 'form_editor_summernote');
    Route::get('/form-element', 'form_element');
    Route::get('/form-pickers', 'form_pickers');
    Route::get('/form-validation-jquery', 'form_validation_jquery');
    Route::get('/form-wizard',  'form_wizard');
    Route::get('/table-bootstrap-basic', 'table_bootstrap_basic');
    Route::get('/table-datatable-basic', 'table_datatable_basic');
    Route::get('/page-error-400', 'page_error_400');
    Route::get('/page-error-403', 'page_error_403');
    Route::get('/page-error-404', 'page_error_404');
    Route::get('/page-error-500', 'page_error_500');
    Route::get('/page-error-503', 'page_error_503');
    Route::get('/page-forgot-password', 'page_forgot_password');
    Route::get('/page-lock-screen', 'page_lock_screen');
    Route::get('/page-login',  [ 'as' => 'login', 'uses' => 'page_login']);
    Route::get('/page-register','page_register');
    Route::post('/ajax/contact-list','ajax_contact_list');
});

Route::controller(MovementsController::class)->group(function () {
    Route::get('/movements',  [ 'as' => 'movements', 'uses' => 'show_movements'])->middleware('auth');
    Route::get('/add-movement',  [ 'as' => 'add_movement', 'uses' => 'add_movement'])->middleware('auth');
    Route::post('/create-movement','create_movement')->middleware('auth');
});

Route::controller(ScheduleController::class)->group(function () {
    Route::get('/schedules',  [ 'as' => 'schedules', 'uses' => 'show_schedules'])->middleware('auth');
    Route::get('/add-schedule',  [ 'as' => 'add_schedule', 'uses' => 'add_schedule'])->middleware('auth');
    Route::post('/create-schedule','create_schedule')->middleware('auth');
});

Route::controller(GeneralController::class)->group(function () {
    Route::get('/',  [ 'as' => 'index', 'uses' => 'show_index'])->middleware('auth');
    Route::get('/index',  [ 'as' => 'index', 'uses' => 'show_index'])->middleware('auth');
    Route::post('/open-gate','open_gate')->middleware('auth');
});

Route::controller(HousesController::class)->group(function () {
    Route::get('/houses',  [ 'as' => 'houses', 'uses' => 'show_houses'])->middleware('auth');
});


Route::controller(NotificationController::class)->group(function () {
    Route::get('/add-notification',  [ 'as' => 'add_notification', 'uses' => 'add_notification'])->middleware('auth');
    Route::post('/create-notification','create_notification')->middleware('auth');
});