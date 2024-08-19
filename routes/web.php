<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatgoryController;
use App\Http\Controllers\Admin\DashbordController;


Route::controller(CatgoryController::class)->group(function(){
    Route::get('/','index')->name('user.home');
    Route::get('/catgory','catgory')->name('user.catgory');
    Route::get('/pastries','pastries')->name('user.pastries');
    Route::get('/meals','meals')->name('user.meals');
    Route::get('/catgory/{id}','show')->name('user.show');
});

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/favorite','index_favorite')->name('user.favorite');
        Route::get('/favorite/store/{meal}','favorite_store')->name('user.favorite.store');
        Route::get('/favorite/show/{meal}','favorite_show')->name('user.favorite.show');
        Route::DELETE('/favorite/delete/{meal}','favorite_destroy')->name('user.favorite.destroy');
        Route::get('/order','index_order')->name('user.order');
        Route::post('addinorder','order_session')->name('user.order.session');
        Route::get('order/cancelall','order_destroy_all')->name('user.session.destroyall');
        Route::post('order/cancelitem','order_destroy_item')->name('user.session.destroyitem');
        Route::post('order/updatequantity','order_update_quantity')->name('user.update.quantity');
        Route::get('order/confirm/','order_confirm')->name('user.confirm');
    });
});



Route::prefix('admin')->middleware(['auth','is_admin'])->group(function (){

    Route::controller(DashbordController::class)->group(function(){
        // all pages of controll panel
        Route::get('dashbord','index')->name('admin.dashbord');
        Route::PUT('dashbord/reject/{order}','orderreject')->name('admin.order.reject');
        Route::PUT('dashbord/accept/{order}','orderaccept')->name('admin.order.accept');
        Route::DELETE('dashbord/Delete/{order}','orderdestroy')->name('admin.order.destroy');
        Route::get('orderhistory','orderhistory')->name('admin.orderhistory');
        Route::get('sales','sales')->name('admin.sales');
        Route::get('Catgories','Catgories')->name('admin.Catgories');
        Route::get('meal','meal')->name('admin.meal');

        Route::POST('catgories/store','catgories_store')->name('admin.catgories.store');
        Route::PUT('catgories/{id}','catgories_update')->name('update.catgory');
        Route::DELETE('catgories/{id}','catgories_destroy')->name('admin.catgories.destroy');

        Route::POST('meal/store','meal_store')->name('admin.meal.store');
        Route::Post('mealdetail/store','mealdetails_store')->name('admin.mealdetail.store');
        Route::PUT('meal/{id}','meal_update')->name('admin.meal.update');
        Route::DELETE('meal/{id}','meal_destroy')->name('admin.meal.destroy');
    });
});

