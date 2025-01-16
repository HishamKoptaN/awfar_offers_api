<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Country;

class CountriesAppController extends Controller
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
                return $this->store(
                    $request,
                );
            case 'PUT':
                return $this->update(
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
            $countries = Country::all();
            return successResponse(
                $countries,
            );
        } catch (\Exception $e) {
            return  failureResponse(
                $e->getMessage(),
            );
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:3',
        ]);
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
            $country->code = $request->input(
                'code',
            );
            $country->save();
            $countries = Country::all();
            return response()->json(
                $countries,
                201,
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
    public function updateCountry(Request $request)
    {
        $countries = Country::all();
        return response()->json(
            $countries,
        );
    }
    public function delete($id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->delete();
            $countries = Country::all();
            return successResponse($countries, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return failureResponse("not found.", 404);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage(), 500);
        }
    }
}
