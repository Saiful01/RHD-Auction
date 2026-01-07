<?php

/*Route::redirect('/', '/login');*/

use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\BidderAuctionRequestController;
use App\Http\Controllers\Admin\BidderController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Bidder\BidController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\AuthController;

Route::get('/', [Controller::class, 'home'])->name('home');
Route::get('/auction-details/{auction}', [Controller::class, 'auction_details'])->name('auction.details');
Route::get('/auction-bid-rules', [Controller::class, 'auction_bid_rules'])->name('auction.bid.rules');

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

    // Document
    Route::delete('documents/destroy', 'DocumentController@massDestroy')->name('documents.massDestroy');
    Route::resource('documents', 'DocumentController');

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
    Route::get('employee/search', [EmployeeController::class, 'search'])->name('employee.search');

    // Auction
    Route::delete('auctions/destroy', 'AuctionController@massDestroy')->name('auctions.massDestroy');
    Route::post('auctions/media', 'AuctionController@storeMedia')->name('auctions.storeMedia');
    Route::post('auctions/ckmedia', 'AuctionController@storeCKEditorImages')->name('auctions.storeCKEditorImages');
    Route::resource('auctions', 'AuctionController');


    // Add  this route for admin approved auction
    Route::get('auctions/approve/{auction}', [AuctionController::class, 'approve'])->name('auctions.approve');
    Route::get('auctions/reject/{auction}', [AuctionController::class, 'reject'])->name('auctions.reject');
    Route::post('auctions/{auction}/toggle-status', [AuctionController::class, 'toggleStatus'])->name('auctions.toggleStatus');

    // Bidder approve for email notification
    Route::get('bidders/approve/{bidder}', [BidderController::class, 'approve'])->name('bidders.approve');


    // Bidder
    Route::delete('bidders/destroy', 'BidderController@massDestroy')->name('bidders.massDestroy');
    Route::post('bidders/media', 'BidderController@storeMedia')->name('bidders.storeMedia');
    Route::post('bidders/ckmedia', 'BidderController@storeCKEditorImages')->name('bidders.storeCKEditorImages');
    Route::resource('bidders', 'BidderController');
    Route::post('bidder/{bidder}/toggle-status', [BidderController::class, 'toggleStatus'])->name('bidders.toggleStatus');

    // Bidder Auction Request
    Route::delete('bidder-auction-requests/destroy', 'BidderAuctionRequestController@massDestroy')->name('bidder-auction-requests.massDestroy');
    Route::post('bidder-auction-requests/media', 'BidderAuctionRequestController@storeMedia')->name('bidder-auction-requests.storeMedia');
    Route::post('bidder-auction-requests/ckmedia', 'BidderAuctionRequestController@storeCKEditorImages')->name('bidder-auction-requests.storeCKEditorImages');
    Route::resource('bidder-auction-requests', 'BidderAuctionRequestController');
    Route::post('bidder-auction-requests/{bidderAuctionRequest}/toggle-status', [BidderAuctionRequestController::class, 'toggleStatus'])->name('bidder-auction-requests.toggleStatus');

    // Bid
    Route::delete('bids/destroy', 'BidController@massDestroy')->name('bids.massDestroy');
    Route::resource('bids', 'BidController');
    Route::post('bids/{bid}/toggle-status', [App\Http\Controllers\Admin\BidController::class, 'toggleStatus'])->name('bids.toggleStatus');
    Route::post('bids/{bid}/toggle-winner', [App\Http\Controllers\Admin\BidController::class, 'toggleWinner'])->name('bids.toggleWinner');
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
    Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest:bidder')->name('login');
    Route::post('/login-submit', [AuthController::class, 'login'])->middleware('guest:bidder')->name('login.submit');
    Route::get('/signup', [AuthController::class, 'showSignup'])->middleware('guest:bidder')->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->middleware('guest:bidder')->name('signup.store');
    Route::get('/pending', [AuthController::class, 'pending'])->name('pending');
});

// bidder dashboard route (authenticated)
Route::middleware(['auth:bidder', 'bidder.status'])->group(function () {
    Route::get('bidder/dashboard', [AuthController::class, 'dashboard'])->name('bidder.dashboard');
    Route::get('bidder/profile', [AuthController::class, 'profile'])->name('bidder.profile');
    Route::post('bidder/update', [AuthController::class, 'update'])->name('bidder.update');
    Route::get('bidder/change-password', [AuthController::class, 'changePassword'])->name('bidder.changePassword');
    Route::post('bidder/change-password', [AuthController::class, 'updatePassword'])->name('bidder.updatePassword');
    Route::post('bidder/logout', [AuthController::class, 'logout'])->name('bidder.logout');
});

// bidder interested auction routes
Route::middleware(['auth:bidder'])->group(function () {
    Route::get('auction/{auction}/interest', [Controller::class, 'showInterestForm'])->name('auction.interest.create');
    Route::post('auction/{auction}/interest', [Controller::class, 'storeInterest'])->name('auction.interest.store');
    Route::get('bidder/interestPending', [Controller::class, 'pendingInterest'])->name('bidderInterest.pending');
    Route::get('/bidder/interest/print/{id}', [Controller::class, 'interestPrint'])
        ->name('bidder.interest.print');
});

// bid route
Route::middleware(['auth:bidder'])->group(function () {
    Route::get('auctions/{auction}/bid', [BidController::class, 'showBidPage'])->name('bid.page');
    Route::post('auctions/{auction}/bid/submit', [BidController::class, 'submitBid'])->name('bid.submit');
});
