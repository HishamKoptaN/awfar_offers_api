<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\City;

class NotificationsDashController extends Controller
{
    public function handleRequest(
        Request $request,
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
                return $this->deleteFile($request);
            default:
                return response()->json(['status' => false, 'message' => 'Invalid request method']);
        }
    }

    protected function get()
    {
        try {
            $notifications = Notification::orderBy('created_at', 'desc')->get();

            return successResponse($notifications);
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
        }
        return response()->json(['status' => true, 'notifications' => $notifications]);
    }
    public function createNotification(Request $request)
    {
        $notificationData = [
            'type' => $request->input('type', 'public'),
            'message' => $request->message,
            'notifiable_id' => json_encode($request->input('notifiable_id', [])),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $notification = Notification::create($notificationData);

        return response()->json([
            'status' => true,
        ], 200);
    }

    public function post(Request $request)
    {
        try {
            $city = new City();
            $city->name = $request->input('name');
            $city->country_id = $request->input('country_id');
            $city->save();
            return $this->successResponse(
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
                return $this->failureResponse('City not found');
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
