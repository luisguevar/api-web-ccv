<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'users'], function ($router) {
    Route::post('/register', "JWTController@register");
    Route::post('/login', "JWTController@loginAdmin");
    Route::post('/login_ecommerce', "JWTController@loginEcommerce");
    Route::post('/logout', "JWTController@logout");
    Route::post('/refresh', "JWTController@refresh");
    Route::post('/profile', "JWTController@profile");
    //
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/all', "UserController@index");
        Route::post('/register', "UserController@store");
        Route::put('/update/{id}', "UserController@update");
        Route::put('/remove/{id}', "UserController@remove");
        Route::delete('/delete/{id}', "UserController@destroy");
    });
});
Route::group(['prefix' => 'products'], function ($router) {
    Route::get("/get_info", "Product\ProductGController@get_info");
    Route::post("/add", "Product\ProductGController@store");
    Route::post("/update/{id}", "Product\ProductGController@update");
    Route::put("/remove/{id}", "Product\ProductGController@remove");
    Route::get("/all", "Product\ProductGController@index");
    Route::get("/show_product/{id}", "Product\ProductGController@show");
    Route::group(["prefix" => "inventario"], function () {
        Route::post("/add", "Product\ProductSizeColorsController@store");
        Route::put("/update_size/{id}", "Product\ProductSizeColorsController@update_size");
        Route::delete("/delete_size/{id}", "Product\ProductSizeColorsController@destroy_size");
        //
        Route::put("/update/{id}", "Product\ProductSizeColorsController@update");
        Route::delete("/delete/{id}", "Product\ProductSizeColorsController@destroy");
    });
    Route::group(["prefix" => "imgs"], function () {
        Route::post("/add", "Product\ProductImagensController@store");
        Route::delete("/delete/{id}", "Product\ProductImagensController@destroy");
    });
    Route::group(["prefix" => "categories"], function () {
        Route::get("/all", "Product\CategorieController@index");
        Route::post("/add", "Product\CategorieController@store");
        Route::post("/update/{id}", "Product\CategorieController@update");
        Route::delete("/delete/{id}", "Product\CategorieController@destroy");
        Route::put('/remove/{id}', "Product\CategorieController@remove");
    });
});
Route::group(['prefix' => 'sliders'], function ($router) {
    Route::get("/all", "Slider\SliderController@index");
    Route::post("/add", "Slider\SliderController@store");
    Route::post("/update/{id}", "Slider\SliderController@update");
    Route::delete("/delete/{id}", "Slider\SliderController@destroy");
});

Route::group(['prefix' => 'cotizaciones'], function ($router) {
    Route::get("/all", "Cotizacion\CotizacionController@index");
    Route::post("/add", "Cotizacion\CotizacionController@store");
    Route::get("/show_cotizacion/{id}", "Cotizacion\CotizacionController@show");
    Route::put("/update/{id}", "Cotizacion\CotizacionController@update");
    Route::put("/remove/{id}", "Cotizacion\CotizacionController@remove");

    Route::get("/allClientes", "Cotizacion\CotizacionController@allClientes");
    Route::get("/allProductos", "Cotizacion\CotizacionController@allProductos");

    Route::post("/addClienteRapido", "Cotizacion\CotizacionController@addClienteRapido");
});



Route::group(['prefix' => 'clientes'], function ($router) {
    Route::get("/all", "Cliente\ClienteController@index");
    Route::post("/add", "Cliente\ClienteController@store");
    Route::post("/update/{id}", "Cliente\ClienteController@update");
    Route::delete("/delete/{id}", "Cliente\ClienteController@destroy");
    Route::put("/remove/{id}", "Cliente\ClienteController@remove");
});

Route::group(['prefix' => 'cupones'], function ($router) {
    Route::get("/all", "Cupones\CuponesController@index");
    Route::get("/config_all", "Cupones\CuponesController@config_all");
    Route::get("/show/{id}", "Cupones\CuponesController@show");
    Route::post("/add", "Cupones\CuponesController@store");
    Route::post("/update/{id}", "Cupones\CuponesController@update");
    Route::delete("/delete/{id}", "Cupones\CuponesController@destroy");
});

Route::group(['prefix' => 'descuentos'], function ($router) {
    Route::get("/all", "Discount\DiscountController@index");
    Route::get("/show/{id}", "Discount\DiscountController@show");
    Route::post("/add", "Discount\DiscountController@store");
    Route::put("/update/{id}", "Discount\DiscountController@update");
    Route::delete("/delete/{id}", "Discount\DiscountController@destroy");
});

// Route::get("sale_mail/{id}","Ecommerce\Sale\SaleController@send_email");

Route::post("sales/all", "Sales\SalesController@sale_all");




Route::group(["prefix" => "ecommerce"], function ($router) {
    Route::get("home", "Ecommerce\HomeController@home");
    Route::post("list-products", "Ecommerce\HomeController@list_product");
    Route::get("detail-product/{slug}", "Ecommerce\HomeController@detail_product");
    Route::get("config_initial_filter", "Ecommerce\HomeController@config_initial_filter");
    Route::group(["prefix" => "cart"], function () {
        Route::get("applycupon/{cupon}", "Ecommerce\Cart\CartShopController@apply_cupon");
        Route::resource("add", "Ecommerce\Cart\CartShopController");
    });
    Route::resource("wishlist", "Ecommerce\Cart\WishListController");
    Route::group(["prefix" => "checkout"], function () {
        Route::resource("address_user", "Ecommerce\Client\AddressUserController");
        Route::post("sale", "Ecommerce\Sale\SaleController@store");
    });
    Route::group(["prefix" => "profile"], function () {
        Route::get("home", "Ecommerce\Profile\ProfileController@index");
        Route::post("profile_update", "Ecommerce\Profile\ProfileController@profile_update");
        Route::resource("reviews", "Ecommerce\Profile\ReviewController");
    });
});

Route::group(['prefix' => 'paises'], function ($router) {
    Route::get("/all", "Pais\PaisController@index");
    Route::get("/show/{pais}", "Pais\PaisController@show");
});








//Modificacion:


Route::group(['prefix' => 'usuarios'], function ($router) {

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/all', "Usuario\UsuarioController@index");
        Route::post("/add", "Usuario\UsuarioController@store");
        Route::post("/update/{id}", "Usuario\UsuarioController@update");
    });
});

Route::group(['prefix' => 'productos'], function ($router) {
    Route::get("/all", "Producto\ProductoController@index");
    Route::post("/add", "Producto\ProductoController@store");
    Route::post("/update/{id}", "Producto\ProductoController@update");
    Route::post("/addImagen", "Producto\ProductoController@addImagen");
    Route::delete("/removeImagen/{id}", "Producto\ProductoController@removeImagen");

    Route::group(["prefix" => "categorias"], function () {
        Route::get("/all", "Producto\CategoriaController@index");
        Route::post("/add", "Producto\CategoriaController@store");
        Route::post("/update/{id}", "Producto\CategoriaController@update");
        Route::put('/remove/{id}', "Producto\CategoriaController@remove");
    });
});

Route::group(['prefix' => 'proveedores'], function ($router) {
    Route::get("/all", "Proveedor\ProveedorController@index");
    Route::post("/add", "Proveedor\ProveedorController@store");
    Route::get("/show_proveedor/{id}", "Proveedor\ProveedorController@show");
    Route::put("/update/{id}", "Proveedor\ProveedorController@update");
    Route::put("/remove/{id}", "Proveedor\ProveedorController@remove");
});
