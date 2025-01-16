<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CitiesDashController extends Controller
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
            $cities = City::all();
            return successResponse($cities);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
        }
    }
    public function post(Request $request)
    {
        try {
            $city = new City();
            $city->name = $request->input('name');
            $city->country_id = $request->input('country_id');
            $city->save();
            return successResponse(
                $city,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function put(Request $request)
    {
        try {
            $city = City::find(
                $request->id,
            );
            if (!$city) {
                return failureResponse('City not found');
            }
            $city->update(
                [
                    'id' => $request->id,
                    'name' => $request->name,
                    'country_id' => $request->country_id,
                ],
            );
            return successResponse(
                $city,
            );
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $country = City::findOrFail($id);
            $country->delete();
            $countries = City::all();
            return successResponse($countries, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return failureResponse("not found.", 404);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage(), 500);
        }
    }
}
