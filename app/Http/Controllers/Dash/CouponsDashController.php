<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponsDashController extends Controller
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
            case 'PUT':
                return $this->put(
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
    public function get()
    {
        try {
            $coupons = Coupon::with("store")->get();
            return successResponse(
                $coupons,
            );
        } catch (\Exception $e) {
            return failureResponse($e->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            return successResponse([], 200);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage(), 500);
        }
    }
    public function post(Request $request)
    {
        try {
            Coupon::create(
                [
                    'code' => $request->code,
                    'store_id' => $request->store_id,
                    'url' => $request->url,
                    'description' => $request->description,
                ],
            );
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function put(
        Request $request,
    ) {
        try {
            $coupon = Coupon::find(
                $request->id,
            );
            if (!$coupon) {
                return $this->failureResponse(
                    'Coupon not found',
                );
            }
            $coupon->update(
                [
                    'code' => $request->code,
                    'store_id' => $request->store_id,
                    'url' => $request->url,
                    'description' => $request->description,
                ],
            );
            return successResponse();
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
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
}
