<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesDashController extends Controller
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
                return failureResponse();
        }
    }
    public function get(
        Request $request,
    ) {
        try {
            $categories = Category::all();
            return successResponse(
                $categories,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function post(
        Request $request,
    ) {
        try {
            $category = Category::create([
                'name' => $request->name,
            ]);
            return successResponse(
                $category,
                201,
            );
        } catch (\Exception $e) {
            return failureResponse($e->getMessage(), 500);
        }
    }
    public function patch(
        Request $request,
    ) {
        try {
            $category = Category::find(
                $request->id,
            );
            $category->update(
                [
                    'id' => $request->id,
                    'name' => $request->name,
                ],
            );
            return successResponse(
                $category,
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
            $category = Category::find(
                $id,
            );
            $category->delete();
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
}
