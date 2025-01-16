<?php


namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsAppController extends Controller
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
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Invalid request method',
                    ],
                );
        }
    }
    public function get(
        $id,
    ) {

        $products = Product::with(
            [
                'offer.offerGroup.store',
            ],
        )
            ->whereHas(
                'marka.subCategory',
                function ($query) use (
                    $id,
                ) {
                    $query->where(
                        'sub_category_id',
                        $id,
                    );
                },
            )
            ->get();

        return response()->json(
            $products,
        );
    }
}
// $products = Product::whereHas(
//     'subCategoryItem.subCategory',
//     function ($query) use ($id) {
//         $query->where('sub_category_id', $id);
//     },
// )->get();
