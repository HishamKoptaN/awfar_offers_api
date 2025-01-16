<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marka;

class MarkasDashController extends Controller
{
    public function handleRequest(
        Request $request,
        $id = null,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->get(
                    $request,
                );
            case 'POST':
                return $this->post(
                    $request,
                );
            case 'PATCH':
                return $this->patch(
                    $request,
                );
            case 'DELETE':
                return $this->delete(
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
        Request $request,
    ) {
        try {
            $subCategories = Marka::all();
            return successResponse(
                $subCategories,
            );
        } catch (\Exception $e) {
            return $this->failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function post(
        Request $request,
    ) {
        try {
            $subCategoryItem = Marka::create(
                [
                    'name' => $request->name,
                    'sub_category_id' => $request->sub_category_id,
                ],
            );
            $subCategoryItem->refresh();
            return successResponse(
                $subCategoryItem,
                201
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function patch(
        Request $request,
    ) {
        try {
            $subCategoryItem = Marka::find(
                $request->id,
            );
            $subCategoryItem->update(
                [
                    'id' => $request->id,
                    'name' => $request->name,
                    'sub_category_id' => $request->sub_category_id,
                ],
            );
            return successResponse(
                $subCategoryItem,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }

    public function delete(
        $id,
    ) {
        try {
            $subCategoryItem = Marka::findOrFail(
                $id,
            );
            $subCategoryItem->delete();
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
}
