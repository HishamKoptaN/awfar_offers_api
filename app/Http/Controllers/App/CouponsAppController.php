<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponsAppController extends Controller
{
    public function handleRequest(
        Request $request,
        $id = null,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->get(
                    $id
                );
            case 'POST':
                return $this->post(
                    $request,
                );
            case 'PUT':
                return $this->put(
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
    public function get($cityId)
    {
        try {
            $coupons = Coupon::with(
                'store',
            )
                ->byCityId(
                    $cityId,
                )
                ->get();
            return successResponse(
                $coupons,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
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
    public function put(Request $request)
    {
        try {
            return successResponse([], 200);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            return successResponse([], 200);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage(), 500);
        }
    }
}
