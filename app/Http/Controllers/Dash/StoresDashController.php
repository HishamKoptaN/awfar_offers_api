<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class StoresDashController extends Controller
{
    public function handleRequest(
        Request $request,
        $id = null,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->get(
                    $request,
                    $id,
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
            $stores = Store::all();
            return successResponse(
                $stores,
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
                'stores',
            );
            $store =   Store::create(
                [
                    'name' => $request->name,
                    'image' =>  $image,
                    'city_id' => $request->city_id,
                    'place' => $request->place,
                ],
            );
            return successResponse(
                $store,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }

    public function edit(
        Request $request,
        $id,
    ) {
        try {
            $store = Store::findOrFail(
                $id,
            );
            if ($request->hasFile('image')) {
                $store->image = updateImage(
                    $request->file(
                        'image',
                    ),
                    'stores',
                    $store->image
                );
            }
            $store->update(
                [
                    'name' => $request->name,
                    'city_id' => $request->city_id,
                    'place' => $request->place,
                ],
            );
            $store->refresh();
            return successResponse(
                $store,
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
            $store = Store::findOrFail(
                $id,
            );
            $store->delete();
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
}
