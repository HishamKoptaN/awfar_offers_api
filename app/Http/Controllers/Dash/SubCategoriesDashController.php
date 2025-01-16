<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoriesDashController extends Controller
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
                if (!$id) {
                    return $this->post(
                        $request,
                    );
                } else {
                    return $this->edit(
                        $request,
                        $id,
                    );
                }
                break;
            case 'DELETE':
                return $this->delete(
                    $id,
                );
            default:
                return failureResponse();
        }
    }
    public function get(Request $request)
    {
        try {
            $categories = SubCategory::all();
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

            $image = uploadImage(
                $request->file(
                    'image',
                ),
                'sub_categories',
            );
            $subCategory = SubCategory::create(
                [
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    'image' => $image,
                ],
            );
            $storedSubCategory = SubCategory::find(
                $subCategory->id,
            );
            return successResponse(
                $storedSubCategory,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            // البحث عن الفئة الفرعية
            $subCategory = SubCategory::find($id);

            // التحقق من وجود الفئة
            if (!$subCategory) {
                return failureResponse('SubCategory not found.');
            }
            if ($request->hasFile('image')) {
                $subCategory->image = updateImage(
                    $request->file('image'),
                    'sub_categories',
                    $subCategory->image
                );
            }
            $subCategory->update(
                [
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                ],
            );
            $subCategory->refresh();

            return successResponse($subCategory);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $subCategory = SubCategory::findOrFail(
                $id,
            );
            $subCategory->delete();
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
}
