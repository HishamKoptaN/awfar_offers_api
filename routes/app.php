<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\SettingsAppController;
use App\Http\Controllers\App\OffersAppController;
use App\Http\Controllers\App\StoresAppController;
use App\Http\Controllers\App\CategoriesAppController;
use App\Http\Controllers\App\SubCategoriesAppController;
use App\Http\Controllers\App\MarkasAppController;
use App\Http\Controllers\App\ProductsAppController;
use App\Http\Controllers\App\CountriesAppController;
use App\Http\Controllers\App\CitiesAppController;
use App\Http\Controllers\App\CouponsAppController;
use App\Http\Controllers\App\NotificationsAppController;
use App\Http\Controllers\App\ExternalNotificationsAppController;

//--------------------Models--------------------//
Route::any(
    '/settings',
    [
        SettingsAppController::class,
        'handleRequest'
    ],
);
Route::any(
    '/stores/{id?}',
    [
        StoresAppController::class,
        'handleStores'
    ],
);
Route::any(
    '/cities/{id?}',
    [
        CitiesAppController::class,
        'handleRequest'
    ],
);
Route::any(
    '/categories/{id?}',
    [
        CategoriesAppController::class,
        'handleRequest'
    ],
);
Route::any(
    '/sub-categories/{id?}',
    [
        SubCategoriesAppController::class,
        'handleRequest'
    ],
);

Route::any(
    '/markas/{id?}',
    [
        MarkasAppController::class,
        'handleRequest'
    ],
);
Route::any(
    '/products/{id?}',
    [
        ProductsAppController::class,
        'handleRequest'
    ],
);

Route::any(
    '/offers/{id?}',
    [
        OffersAppController::class,
        'handleRequest'
    ],
);
Route::any(
    '/countries/{id?}',
    [
        CountriesAppController::class,
        'handleRequest'
    ],
);
Route::any(
    '/coupons/{id?}',
    [
        CouponsAppController::class,
        'handleRequest'
    ],

);
Route::any(
    '/notifications',
    [
        NotificationsAppController::class,
        'handleRequest',
    ],
);
Route::any(
    '/external-notifications',
    [
        ExternalNotificationsAppController::class,
        'handleRequest',
    ],
);
Route::get(
    '/test',
    function () {
        return response()->json(
            [
                'status' => 'Connected',
            ],
            200,
        );
    },
);
