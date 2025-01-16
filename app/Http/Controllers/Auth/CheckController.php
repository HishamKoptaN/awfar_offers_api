<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckAuthController extends Controller
{
    public function check()
    {
        try {
            if (!Auth::guard('sanctum')->check()) {
                return failureResponse(
                    [],
                    401,
                );
            }
            $user = Auth::guard('sanctum')->user();
            return successResponse(
                $user,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
}
