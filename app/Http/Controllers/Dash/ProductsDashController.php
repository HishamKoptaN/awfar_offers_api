<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsDashController extends Controller
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
            case 'POST':
                return $this->post(
                    $request,
                );
            case 'PUT':
                return $this->put(
                    $request,
                    $id,
                );
            case 'PATCH':
                return $this->patch(
                    $request,
                    $id,
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
        $id,
    ) {
        try {
            $products = Product::where(
                'offer_id',
                $id,
            )->get();
            return successResponse(
                $products,
            );
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
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
                'products',
            );
            $product =   Product::create(
                [
                    'name' => $request->name,
                    'image' => $image,
                    'price' => $request->price,
                    'discount_rate' => $request->discount_rate,
                    'offer_id' => $request->offer_id,
                    'marka_id' => $request->marka_id,
                ],
            );
            return successResponse(
                $product,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }

    public function put(
        Request $request,
        $id,
    ) {
        try {
            $product = Product::findOrFail(
                $request->id,
            );
            $image = uploadImage(
                $request->file(
                    'image',
                ),
                'product',
            );
            $product->update(
                [
                    'name' => $request->name,
                    'country_id' => $request->country_id,
                    'city_id' => $request->city_id,
                    'place' => $request->place,
                ],
            );
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function editImage(
        Request $request,
        $id,
    ) {
        try {
            $product = Product::findOrFail(
                $id,
            );
            $image = uploadImage(
                $request->file(
                    'image',
                ),
                'product',
            );
            $product->update(
                [
                    'image' => $image,
                ],
            );
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
}
