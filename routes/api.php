<?php

use App\Http\Controllers\Actions\CancelSubscription;
use App\Http\Controllers\Actions\GenerateStripeSession;
use App\Http\Controllers\Actions\GetBaseUrl;
use App\Http\Controllers\Actions\GetPrices;
use App\Http\Controllers\Actions\GetStripeKey;
use App\Http\Controllers\Actions\RegisterNewStore;
use App\Http\Controllers\Actions\RetrieveSessionData;
use App\Http\Controllers\Actions\UpdateSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Please refer to the README.md file for information on purpose,
| usage and status
|
*/


/*
|--------------------------------------------------------------------------
| free-access routes
|--------------------------------------------------------------------------
*/
/*
    |--------------------------------------------------------------------------
    | login/register/logout
    |--------------------------------------------------------------------------
*/

Route::post('register/new-retailer', 'Actions\RegisterNewStore');
Route::post('register/{type}', 'API\APIRegisterController@register');
Route::post('login', 'API\APILoginController@login');
Route::post('reset_password', 'UserController@reset_password');
// TODO - add logout route

/*
    |--------------------------------------------------------------------------
    | retails routes
    |--------------------------------------------------------------------------
*/
Route::get('/retails/zip_code/{zip}', 'RetailerController@index_by_zip');
Route::get('/retails', 'RetailerController@index');
Route::get('/retails/{retailer}', 'RetailerController@show');
Route::get('/retails/by-slug/{slug}', 'RetailerController@find_by_slug');
Route::get('/retails/by-vat/{vat}', 'RetailerController@find_by_vat');
Route::get('/retails/detail/{slug}/{vat}', 'RetailerController@detail');

/*
    |--------------------------------------------------------------------------
    | items routes
    |--------------------------------------------------------------------------
*/
Route::get('/retails/{retailer}/items', 'ItemController@index');
Route::get('/retails/{retailer}/items/{item}', 'ItemController@show');


/*
    |--------------------------------------------------------------------------
    | addresses routes
    |--------------------------------------------------------------------------
*/
Route::get('/addresses', 'AddressController@index');

/*
    |--------------------------------------------------------------------------
    | orders routes
    |--------------------------------------------------------------------------
*/
Route::get('/orders', 'OrderController@index');
Route::get('/orders/{order}', 'OrderController@show');

/*
    |--------------------------------------------------------------------------
    | district routes
    |--------------------------------------------------------------------------
*/
Route::get('/districts/index', 'ItalianDistrictController@index');
Route::get('/districts/{district}', 'ItalianDistrictController@index_by_query');
Route::get('/zip/{zip}', 'ZipCodeController@show_query');

Route::get('/categories/{category}', 'CategoryController@index_by_query');

// TODO - re-test free-access routes
// TODO - put free-access routes behind a client or some sort of app-level auth


/*
|--------------------------------------------------------------------------
| /api routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:api'], function () {
    /*
    |----------------------------------------------------------------------
    | /api/retails routes
    |----------------------------------------------------------------------
    */
    Route::prefix('retails')->group(function () {
        // Route::get('/', 'RetailerController@index');
        // Route::get('/zip_code/{zip}', 'RetailerController@index_by_zip');
        Route::post('/create', 'RetailerController@store');
        // Route::get('/{retailer}', 'RetailerController@show');
        Route::put('/{retailer}', 'RetailerController@update');
        Route::delete('/{retailer}', 'RetailerController@destroy');
        Route::get('/{retailer}/is_premium', 'RetailerController@is_premium');
        Route::get('/{retailer}/get_slug', 'RetailerController@get_slug');
    });

    /*
    |----------------------------------------------------------------------
    | /apipsers routes
    |----------------------------------------------------------------------
    */
    Route::prefix('users')->group(function () {
        Route::post('/{user}/change_password', 'UserController@change_password');
        Route::get('/{user}', 'UserController@show');
        Route::put('/{user}', 'UserController@update');
        Route::delete('/{user}', 'UserController@destroy');
    });
    Route::get('/retails/detail/{retailer}', 'RetailerController@detail');

    /*
    |----------------------------------------------------------------------
    | /api/retails/{retail}/items routes
    |----------------------------------------------------------------------
    */
    Route::prefix('retails/{retailer}/items')->group(function () {
        // Route::get('/', 'ItemController@index');
        // Route::get('/{item}', 'ItemController@show');
        Route::post('/create', 'ItemController@store');
        Route::put('/{item}', 'ItemController@update');
        Route::delete('/{item}', 'ItemController@destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | test Item Images
    |--------------------------------------------------------------------------
    */
    Route::get('retails/{retailer}/items/{item}/images', 'ItemImageController@index');
    Route::post('retails/{retailer}/items/{item}/images', 'ItemImageController@store')->name('item_image.store');
    Route::delete('retails/{retailer}/items/{item}/images/{id}', 'ItemImageController@destroy');
    //Route::post('images', 'ImageController@store')->name('images.store');



    /*
    |----------------------------------------------------------------------
    | /api/retails/{retail}/orders routes
    |----------------------------------------------------------------------
    */
    Route::prefix('retails/{retailer}/orders')->group(function () {
        Route::get('/', 'OrderController@getListOfOrders');
        Route::get('/{order}', 'OrderController@orderDetails');
        Route::post('/{order}/change_status', 'OrderController@changeOrderStatus');
    });

    /*
    |----------------------------------------------------------------------
    | /api/addresses routes
    |----------------------------------------------------------------------
    */
    Route::prefix('addresses')->group(function () {
        // Route::get('/', 'AddressController@index');
        // Route::get('/{address}', 'AddressController@show');
        Route::post('/create', 'AddressController@store');
        Route::put('/{address}', 'AddressController@update');
        Route::delete('/{address}', 'AddressController@destroy');
    });

    /*
    |----------------------------------------------------------------------
    | /api/orders routes
    |----------------------------------------------------------------------
    */
    Route::prefix('orders')->group(function () {
        Route::get('/{order}/submit', 'OrderController@submit');
        // Route::get('/', 'OrderController@index');
        // Route::get('/{order}', 'OrderController@show');
        Route::post('/create', 'OrderController@store');
        Route::put('/{order}', 'OrderController@update');
        Route::delete('/{order}', 'OrderController@destroy');
        Route::get('/{order}/cancel', 'OrderController@cancelOrder');
    });

    /*
    |----------------------------------------------------------------------
    | /api/categories order
    |----------------------------------------------------------------------
    */
    Route::prefix('retails/{retailer}/categories')->group(function () {
        Route::get('/list', 'RetailerController@get_list_of_category');
        // Route::get('/{order}', 'OrderController@show');
        Route::post('/add_category', 'RetailerController@add_category');
        Route::delete('/{category}', 'RetailerController@remove_category');
    });

    /*
    |----------------------------------------------------------------------
    | /api/tags order
    |----------------------------------------------------------------------
    */
    Route::prefix('retails/{retailer}/tags')->group(function () {
        Route::get('/list', 'TagController@index');
        Route::post('/add_tag', 'TagController@store');
        Route::delete('/{tag}', 'TagController@destroy');
    });
});


/*
|--------------------------------------------------------------------------
| administrator routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:api', 'role:administrator']], function () {
    /*
    |----------------------------------------------------------------------
    | /api{/users} routes
    |----------------------------------------------------------------------
    */
    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index');
        Route::post('/create', 'UserController@store');
    });
});


/*
|--------------------------------------------------------------------------
| test routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test/info_json', 'TestController@info_json');
Route::get('/test/init_info', 'TestController@initialize_info_fields');
Route::get('/test/payments', 'TestController@add_payments_to_info_field');
Route::get('/test/payment_info', 'TestController@add_is_paid_to_delivery_info');
Route::post('/test/pay', 'TestController@pay');

Route::post('/image_upload', 'UtilityController@image_upload');
Route::get('/orderStatuses', 'OrderStatusController@index');
Route::get('/lastUnsubmittedOrder', 'OrderController@getLastUnsubmittedOrder');
Route::post('/orders/tempStore', 'OrderController@tempStore');
Route::post('/orders/{order}/assign_item', 'OrderController@assignItem');
Route::get('/utility/clean_orders', 'UtilityController@delete_open_orders');

Route::get('/mail', 'UtilityController@send_mail');
Route::get('/preview', 'UtilityController@preview_mail');
Route::get('/orders/{order}/notify', 'OrderController@notify');
Route::post('/contacts', 'UtilityController@contacts');
Route::get('/orders/{order}/pdf', 'UtilityController@pdf');
Route::get('/orders/{order}/pdf-retailer', 'UtilityController@pdfRetailer');

Route::post('/check_repeated', 'UtilityController@check_repeated');
Route::post('/checkout', 'TestController@checkout');

Route::get('/random-string', 'UtilityController@randomString');
Route::get('/base-url', 'Actions\GetBaseUrl');

// siwego api
Route::get('/siwego', 'SiwegoController@index');

// offline pwa
Route::view('offline', 'offline');

// stripe session API
Route::post('/stripe/{user}/generate-session', 'Actions\GenerateStripeSession');
Route::post('/stripe/retrieve-session', 'Actions\RetrieveSessionData');
Route::get('/stripe/get-stripe-pk', 'Actions\GetStripeKey');
Route::get('/stripe/get-prices', 'Actions\GetPrices');
Route::post('/stripe/{user}/subscription/update', 'Actions\UpdateSubscription');
Route::post('/stripe/{user}/subscription/cancel', 'Actions\CancelSubscription');
