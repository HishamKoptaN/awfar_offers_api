<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Country;

class CountriesDashController extends Controller
{
    public function handleRequest(Request $request, $id = null)
    {
        switch ($request->method()) {
            case 'GET':
                return $this->get($request);
            case 'POST':
                return $this->post($request);
            case 'PUT':
                return $this->put($request);
            case 'DELETE':
                return $this->delete($id);
            default:
                return failureResponse();
        }
    }
    public function get()
    {
        try {
            $countries = Country::all();
            return successResponse($countries);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
        }
    }

    public function post(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|string|max:3',
            ],
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }
        try {
            $country = new Country();
            $country->code = $request->input('code');
            $country->save();
            return successResponse(
                $country,
            );
        } catch (Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function put(Request $request)
    {
        try {
            $country = Country::find(
                $request->id,
            );
            if (!$country) {
                return failureResponse(
                    'City not found',
                );
            }
            $country->update(
                [
                    'code' => $request->code,

                ],
            );
            return successResponse(
                $country,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function delete($id)
    {
        try {
            $country = Country::findOrFail(
                $id,
            );
            $country->delete();
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
}
