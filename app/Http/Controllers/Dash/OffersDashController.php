<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Offer;

class OffersDashController extends Controller
{
    public function handleRequest(
        Request $request,
        $id = null,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->get();
            case 'POST':
                return $this->post(
                    $request,
                );
                break;
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
    public function get()
    {
        try {
            $offers = Offer::all();
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
            $request->validate(
                [
                    'offer_group_id' => 'required|exists:offer_groups,id',
                    'image' => 'required|image',

                ],
            );
            $image = uploadImage(
                $request->file(
                    'image',
                ),
                'offers',
            );
            Offer::create(
                [
                    'offer_group_id' => $request->offer_group_id,
                    'image' => 'https://api.awfar-offers.com/storage/offer.jpg',
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
            $store = Offer::findOrFail($id);
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
            $store = Offer::findOrFail(
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
    } // public function put(
    //     Request $request,
    //     $id,
    // ) {

    //     try {
    //         $store = Offer::findOrFail(
    //             $request->id,
    //         );
    //         $endAt = trim($request->input('end_at'), '"');
    //         $endAtFormatted = Carbon::createFromFormat('d/m/Y', $endAt)->format('Y-m-d');
    //         $store->update(
    //             [
    //                 'name' => $request->name,
    //                 'end_at' => $endAtFormatted,
    //                 'store_id' => $request->store_id,
    //                 'country_id' => $request->country_id,
    //                 'sub_category_id' => $request->sub_category_id,
    //                 'description' => $request->description,
    //             ],
    //         );
    //         return successResponse();
    //     } catch (\Exception $e) {
    //         return failureResponse($e->getMessage());
    //     }
    // }
}
