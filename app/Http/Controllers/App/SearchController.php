<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductSearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('query');
        // البحث في المنتجات مع الفئات
        $products = Product::with('category')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->get();
        // تهيئة الاستجابة
        return response()->json([
            'success' => true,
            'data' => $products->map(function ($product) {
                return [
                    'product_name' => $product->name,
                    'category_name' => $product->category->name,
                ];
            }),
        ]);
    }
}
