<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AdminUpdateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes
require __DIR__.'/auth.php';

// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('dashboard', 'App\Http\Controllers\Frontend\FrontendController@index')->name('dashboard');
/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');
    Route::get('home', 'FrontendController@index')->name('home');
    Route::get('privacy', 'FrontendController@privacy')->name('privacy');
    Route::get('terms', 'FrontendController@terms')->name('terms');
    Route::get('custompage', 'FrontendController@custompage')->name('custompage');
    Route::get('lyrics', 'SongController@index')->name('song');
    Route::get('lyrics/{slug}', 'SongController@show')->name('song.show');
    Route::get('/all-songs', 'SongController@index')->name('all-songs');
    Route::get('/all-songs/{slug}', 'SongController@show')->name('songs.show');
    Route::get('/search/all-songs', 'SongController@search')->name('song.search');
    
    Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {

        /**
         * -------------------------------------------------------------------
         * Package Route
         * -------------------------------------------------------------------
         */
        Route::group(['prefix' => 'package'], function() {
            Route::get('/package', 'PackageController@index')->name('package');
            Route::get('/package/{slug}', 'PackageController@show')->name('package.show');
            Route::get('/package/{slug}/payment', 'PackageController@payment')->name('package.payment');
            Route::post('/package/{slug}/payment', 'PackageController@paymentgateway')->name('package.payment.gateway');
            Route::get('/package/{slug}/payment/success', 'PackageController@paymentSuccess')->name('package.payment.success');
            Route::get('/package/{slug}/payment/cancel', 'PackageController@paymentCancel')->name('package.payment.cancel');
        });

        /**
         * -------------------------------------------------------------------
         * SongCheckout Route
         * -------------------------------------------------------------------
         */
        Route::group(['prefix' => 'checkout'], function() {
            Route::get('/song', 'SongCheckoutController@index')->name('checkout.song');
        });


        /*
        * ---------------------------------------------------------------------
        *  Users Routes
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('/{slug}', 'UserController@dashboard')->name('users.dashboard');
        Route::get('profile/{id}', ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
        Route::get('profile/{id}/edit', ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
        Route::patch('profile/{id}/edit', ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
        Route::get('profile/changePassword/{username}', ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
        Route::patch('profile/changePassword/{username}', ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
        Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
        Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'can:view_backend']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {
    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    // web.php
    Route::get('admin/update', [AdminUpdateController::class, 'performUpdate'])->name('admin.update.perform');


    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
    });

    /**
     * 
     * Artists Routes
     */
    Route::group(['middleware' => ['permission:edit_artists']], function () {
        $module_name = 'artists';
        $controller_name = 'ArtistController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::get("$module_name/create", "$controller_name@create")->name("$module_name.create");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
        Route::get("$module_name/{id}/edit", "$controller_name@edit")->name("$module_name.edit");
        Route::post("$module_name/{id}", "$controller_name@update")->name("$module_name.update");
        Route::get("$module_name/{id}/show", "$controller_name@show")->name("$module_name.show");
        Route::delete("$module_name/{id}", "$controller_name@destroy")->name("$module_name.destroy");
    });

    /**
     * 
     * Song Categories Routes
     */
    Route::group(['middleware' => ['permission:edit_song_categories']], function () {
        $module_name = 'song_categories';
        $controller_name = 'SongCategoryController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::get("$module_name/create", "$controller_name@create")->name("$module_name.create");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
        Route::get("$module_name/{id}/edit", "$controller_name@edit")->name("$module_name.edit");
        Route::post("$module_name/{id}", "$controller_name@update")->name("$module_name.update");
        Route::get("$module_name/{id}/show", "$controller_name@show")->name("$module_name.show");
        Route::delete("$module_name/{id}", "$controller_name@destroy")->name("$module_name.destroy");
    });
    
    /**
     * 
     * Songs Routes
     */
    Route::group(['middleware' => ['permission:edit_songs']], function () {
        $module_name = 'songs';
        $controller_name = 'SongController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::get("$module_name/create", "$controller_name@create")->name("$module_name.create");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
        Route::get("$module_name/{id}/edit", "$controller_name@edit")->name("$module_name.edit");
        Route::post("$module_name/{id}", "$controller_name@update")->name("$module_name.update");
        Route::get("$module_name/{id}/show", "$controller_name@show")->name("$module_name.show");
        Route::delete("$module_name/{id}", "$controller_name@destroy")->name("$module_name.destroy");
    });

    /**
     * 
     * Package Routes
     */
    Route::group(['middleware' => ['permission:edit_our_packages']], function () {
        $module_name = 'packages';
        $controller_name = 'PackageController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::get("$module_name/create", "$controller_name@create")->name("$module_name.create");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
        Route::get("$module_name/{id}/edit", "$controller_name@edit")->name("$module_name.edit");
        Route::post("$module_name/{id}", "$controller_name@update")->name("$module_name.update");
        Route::get("$module_name/{id}/show", "$controller_name@show")->name("$module_name.show");
        Route::delete("$module_name/{id}", "$controller_name@destroy")->name("$module_name.destroy");
    });

    /**
     * 
     * Payment Routes
     */
    Route::group(['middleware' => ['permission:edit_our_packages']], function () {
        $module_name = 'payments';
        $controller_name = 'PaymentController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::get("$module_name/pending", "$controller_name@pending")->name("$module_name.pending");
        Route::get("$module_name/create", "$controller_name@create")->name("$module_name.create");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
        Route::get("$module_name/{id}/edit", "$controller_name@edit")->name("$module_name.edit");
        Route::post("$module_name/{id}", "$controller_name@update")->name("$module_name.update");
        Route::get("$module_name/{id}/show", "$controller_name@show")->name("$module_name.show");
        Route::delete("$module_name/{id}", "$controller_name@destroy")->name("$module_name.destroy");
    });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/markAllAsRead", ['as' => "$module_name.markAllAsRead", 'uses' => "$controller_name@markAllAsRead"]);
    Route::delete("$module_name/deleteAll", ['as' => "$module_name.deleteAll", 'uses' => "$controller_name@deleteAll"]);
    Route::get("$module_name/{id}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/create", ['as' => "$module_name.create", 'uses' => "$controller_name@create"]);
    Route::get("$module_name/download/{file_name}", ['as' => "$module_name.download", 'uses' => "$controller_name@download"]);
    Route::get("$module_name/delete/{file_name}", ['as' => "$module_name.delete", 'uses' => "$controller_name@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("$module_name", "$controller_name");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("$module_name/profile/{id}", ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
    Route::get("$module_name/profile/{id}/edit", ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
    Route::patch("$module_name/profile/{id}/edit", ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
    Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
    Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    Route::get("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePassword", 'uses' => "$controller_name@changeProfilePassword"]);
    Route::patch("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePasswordUpdate", 'uses' => "$controller_name@changeProfilePasswordUpdate"]);
    Route::get("$module_name/changePassword/{id}", ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
    Route::patch("$module_name/changePassword/{id}", ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::resource("$module_name", "$controller_name");
    Route::patch("$module_name/{id}/block", ['as' => "$module_name.block", 'uses' => "$controller_name@block", 'middleware' => ['permission:block_users']]);
    Route::patch("$module_name/{id}/unblock", ['as' => "$module_name.unblock", 'uses' => "$controller_name@unblock", 'middleware' => ['permission:block_users']]);
});
