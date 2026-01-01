<?php

/*Route::redirect('/', '/login');*/

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\AuthController;

Route::get('/', [Controller::class, 'home'])->name('home');
Route::get('/auction-details/{auction}', [Controller::class, 'auction_details'])->name('auction.details');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Financial Year
    Route::delete('financial-years/destroy', 'FinancialYearController@massDestroy')->name('financial-years.massDestroy');
    Route::resource('financial-years', 'FinancialYearController');

    // Division
    Route::delete('divisions/destroy', 'DivisionController@massDestroy')->name('divisions.massDestroy');
    Route::resource('divisions', 'DivisionController');

    // Road
    Route::delete('roads/destroy', 'RoadController@massDestroy')->name('roads.massDestroy');
    Route::post('roads/media', 'RoadController@storeMedia')->name('roads.storeMedia');
    Route::post('roads/ckmedia', 'RoadController@storeCKEditorImages')->name('roads.storeCKEditorImages');
    Route::resource('roads', 'RoadController');

    // Package
    Route::delete('packages/destroy', 'PackageController@massDestroy')->name('packages.massDestroy');
    Route::post('packages/media', 'PackageController@storeMedia')->name('packages.storeMedia');
    Route::post('packages/ckmedia', 'PackageController@storeCKEditorImages')->name('packages.storeCKEditorImages');
    Route::resource('packages', 'PackageController');

    // Lot
    Route::delete('lots/destroy', 'LotController@massDestroy')->name('lots.massDestroy');
    Route::post('lots/media', 'LotController@storeMedia')->name('lots.storeMedia');
    Route::post('lots/ckmedia', 'LotController@storeCKEditorImages')->name('lots.storeCKEditorImages');
    Route::resource('lots', 'LotController');

    // Lot Item
    Route::delete('lot-items/destroy', 'LotItemController@massDestroy')->name('lot-items.massDestroy');
    Route::post('lot-items/media', 'LotItemController@storeMedia')->name('lot-items.storeMedia');
    Route::post('lot-items/ckmedia', 'LotItemController@storeCKEditorImages')->name('lot-items.storeCKEditorImages');
    Route::resource('lot-items', 'LotItemController');

    // Lot Item create/store under Lot without touching existing resource routes
    Route::prefix('lots')->name('lots.')->group(function () {
        Route::get('lot-items/create/{lot?}', 'LotItemController@newCreate')->name('lot-items.newCreate');
        Route::post('lot-items/new-store', 'LotItemController@newStore')->name('lot-items.newStore');
        Route::put('lot-items/new-update/{lotItem}', 'LotItemController@newUpdate')
            ->name('lot-items.newUpdate');
        Route::delete('lot-items/delete/{lotItem}', 'LotItemController@destroy')->name('lot-items.destroy');
    });



    // Office Type
    Route::delete('office-types/destroy', 'OfficeTypeController@massDestroy')->name('office-types.massDestroy');
    Route::resource('office-types', 'OfficeTypeController');

    // Office
    Route::delete('offices/destroy', 'OfficeController@massDestroy')->name('offices.massDestroy');
    Route::resource('offices', 'OfficeController');

    // Designation
    Route::delete('designations/destroy', 'DesignationController@massDestroy')->name('designations.massDestroy');
    Route::resource('designations', 'DesignationController');

    // Employee
    Route::delete('employees/destroy', 'EmployeeController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeeController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeeController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::resource('employees', 'EmployeeController');

    // Auction
    Route::delete('auctions/destroy', 'AuctionController@massDestroy')->name('auctions.massDestroy');
    Route::post('auctions/media', 'AuctionController@storeMedia')->name('auctions.storeMedia');
    Route::post('auctions/ckmedia', 'AuctionController@storeCKEditorImages')->name('auctions.storeCKEditorImages');
    Route::resource('auctions', 'AuctionController');


    // Bidder
    Route::delete('bidders/destroy', 'BidderController@massDestroy')->name('bidders.massDestroy');
    Route::post('bidders/media', 'BidderController@storeMedia')->name('bidders.storeMedia');
    Route::post('bidders/ckmedia', 'BidderController@storeCKEditorImages')->name('bidders.storeCKEditorImages');
    Route::resource('bidders', 'BidderController');

    // Bidder Auction Request
    Route::delete('bidder-auction-requests/destroy', 'BidderAuctionRequestController@massDestroy')->name('bidder-auction-requests.massDestroy');
    Route::post('bidder-auction-requests/media', 'BidderAuctionRequestController@storeMedia')->name('bidder-auction-requests.storeMedia');
    Route::post('bidder-auction-requests/ckmedia', 'BidderAuctionRequestController@storeCKEditorImages')->name('bidder-auction-requests.storeCKEditorImages');
    Route::resource('bidder-auction-requests', 'BidderAuctionRequestController');

    // Bid
    Route::delete('bids/destroy', 'BidController@massDestroy')->name('bids.massDestroy');
    Route::resource('bids', 'BidController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});


//bidder info route (authenticated)
Route::prefix('bidder')->name('bidder.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
});
