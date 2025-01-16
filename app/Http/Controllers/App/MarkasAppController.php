<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marka;

class MarkasAppController extends Controller
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
        $subCategoriesIStores = Marka::withCount(
            'products',
        )->where(
            'sub_category_id',
            $id,
        )->get();

        return response()->json(
            $subCategoriesIStores,
        );
    }
}
