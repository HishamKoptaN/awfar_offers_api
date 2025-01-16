<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OfferGroup;

class OfferGroupsDash extends Controller
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
                break;
            case 'PUT':
                return $this->put(
                    $request,
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
            $offers = OfferGroup::where(
                'store_id',
                $id,
            )->with('offers')->get();
            return successResponse(
                $offers,
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
            $offerGroup = OfferGroup::create(
                [
                    'name' => $request->name,
                    'store_id' => $request->store_id,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                ],
            );
            return successResponse(
                $offerGroup,
            );
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
        }
    }
    public function put(
        Request $request,
    ) {

        try {
            $store = OfferGroup::findOrFail(
                $request->id,
            );
            $endAt = trim($request->input('end_at'), '"');
            $endAtFormatted = Carbon::createFromFormat('d/m/Y', $endAt)->format('Y-m-d');
            $store->update(
                [
                    'name' => $request->name,
                    'end_at' => $endAtFormatted,
                    'store_id' => $request->store_id,
                    'description' => $request->description,
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
            $store = OfferGroup::findOrFail($id);
            $store->delete();
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
            $store = OfferGroup::findOrFail(
                $id,
            );
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(
                    public_path('storage/offers'),
                    $imageName,
                );
                $url = asset(
                    'storage/offers/' . $imageName,
                );
            } else {
                $url = $store->image;
            }
            $store->update(
                [
                    'image' => $url,
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
