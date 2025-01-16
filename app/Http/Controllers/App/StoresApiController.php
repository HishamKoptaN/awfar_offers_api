<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class StoresAppController extends Controller
{
    public function handleStores(
        Request $request,
        $id = null,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->get(
                    $id,
                );
            case 'POST':
                return $this->sendMessage(
                    $request,
                    $id,
                );
            default:
                return failureResponse()->json();
        }
    }
    public function get(
        $id,
    ) {
        $stores = Store::where(
            'city_id',
            $id,
        )
            ->whereHas(
                'offerGroups',
            )
            ->with(
                'offerGroups.offers',
            )
            ->get();
        return successResponse(
            $stores,
        );
    }
}
