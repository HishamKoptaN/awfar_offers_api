<?php

use Illuminate\Support\Facades\Route;
//--------------------Dash--------------------//
use App\Http\Controllers\Dash\RolesDashController;
use App\Http\Controllers\Dash\PermissionsDashController;
use App\Http\Controllers\Dash\CountriesDashController;
use App\Http\Controllers\Dash\CitiesDashController;
use App\Http\Controllers\Dash\StoresDashController;
use App\Http\Controllers\Dash\OfferGroupsDash;
use App\Http\Controllers\Dash\CategoriesDashController;
use App\Http\Controllers\Dash\SubCategoriesDashController;
use App\Http\Controllers\Dash\markasDashController;
use App\Http\Controllers\Dash\ProductsDashController;
use App\Http\Controllers\Dash\OffersDashController;
use App\Http\Controllers\Dash\CouponsDashController;
use App\Http\Controllers\Dash\NotificationsDashController;
use App\Http\Controllers\Dash\UsersDashController;
use App\Http\Controllers\Dash\ExternalNotificationsDashController;

Route::any(
    '/roles/{id?}',
    [
        RolesDashController::class,
        'handleRequest',
    ],
);
Route::any(
    '/permissions/{id?}',
    [
        PermissionsDashController::class,
        'handleRequest',
    ],
);
Route::any(
    '/offers/{id?}',
    [
        OffersDashController::class,
        'handleRequest',
    ],

);
Route::any(
    '/categories/{id?}',
    [
        CategoriesDashController::class,
        'handleRequest',
    ],

);
Route::any(
    '/sub-categories/{id?}',
    [
        SubCategoriesDashController::class,
        'handleRequest',
    ],

);
Route::any(
    '/markas/{id?}',
    [
        markasDashController::class,
        'handleRequest'
    ],
);
Route::any(
    '/stores/{id?}',
    [
        StoresDashController::class,
        'handleRequest'
    ],
);
Route::any(
    '/offer-groups/{id?}',
    [
        OfferGroupsDash::class,
        'handleRequest'
    ],
);
Route::any(
    '/products/{id?}',
    [
        ProductsDashController::class,
        'handleRequest'
    ],
);
Route::any(
    '/cities/{id?}',
    [
        CitiesDashController::class,
        'handleRequest'
    ],
);
Route::any(
    '/countries/{id?}',
    [
        CountriesDashController::class,
        'handleRequest'
    ],
);
Route::any(
    '/coupons/{id?}',
    [
        CouponsDashController::class,
        'handleRequest'
    ],
);
Route::any(
    '/notifications',
    [
        NotificationsDashController::class,
        'handleRequest',
    ],
);
Route::any(
    '/users',
    [
        UsersDashController::class,
        'handleRequest',
    ],
);
Route::any(
    '/external-notifications',
    [
        ExternalNotificationsDashController::class,
        'handleRequest',
    ],
);
Route::get(
    '/test',
    function () {
        return "Dash route Connected";
    },
);
