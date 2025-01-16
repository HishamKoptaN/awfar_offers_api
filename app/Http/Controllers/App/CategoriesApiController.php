<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use App\Models\Product;

class CategoriesAppController extends Controller
{
    public function handleRequest(
        Request $request,
        $id = null,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->get(
                    $id,
                );
            default:
                return failureResponse();
        }
    }
    public function get(
        $id,
    ) {
        $categories = Category::all();
        // $categories = Category::whereHas(
        //     'offerGroups',
        //     function (
        //         $query,
        //     ) use (
        //         $id,
        //     ) {
        //         $query->whereHas(
        //             'store',
        //             function ($query) use (
        //                 $id,
        //             ) {
        //                 $query->where(
        //                     'city_id',
        //                     $id,
        //                 );
        //             }
        //         );
        //     }
        // )
        //     ->with(
        //         [
        //             'offerGroups' => function (
        //                 $query,
        //             ) use (
        //                 $id,
        //             ) {
        //                 $query->whereHas(
        //                     'store',
        //                     function ($query) use (
        //                         $id,
        //                     ) {
        //                         $query->where(
        //                             'city_id',
        //                             $id,
        //                         );
        //                     }
        //                 );
        //             },
        //             'subCategories',
        //         ],
        //     )
        //     ->get();
        return successResponse(
            $categories,
        );
    }
}
