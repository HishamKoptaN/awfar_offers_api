<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoriesAppController extends Controller
{
    public function handleRequest(
        Request $request,
        $id = null,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->get();
            default:
                return failureResponse();
        }
    }
    public function get()
    {
        $subCategories = SubCategory::withCount(
            'subCategoryItems',
        )->get();
        return response()->json($subCategories);
    }
}
