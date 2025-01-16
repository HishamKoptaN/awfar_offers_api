<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationToken;

class ExternalNotificationsAppController extends Controller
{
    public function handleRequest(
        Request $request,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->getNotifications(
                    $request,
                );
            case 'POST':
                return $this->post(
                    $request,
                );
            case 'PUT':
                return $this->updateFile(
                    $request,
                );
            case 'DELETE':
                return $this->deleteFile(
                    $request,
                );
            default:
                return response()->json(['status' => false, 'message' => 'Invalid request method'], 405);
        }
    }
    public function getNotifications(Request $request)
    {
        try {
            $notifications = Notification::with('store')->get()->map(
                function ($notification) {
                    return [
                        'id' => $notification->id,
                        'type' => $notification->type,
                        'message' => $notification->message,
                        'image' => $notification->image,
                        'read_at' => $notification->read_at,
                        'store' => $notification->store ? [
                            'id' => $notification->store->id,
                            'name' => $notification->store->name,
                            'image' => $notification->store->image,
                        ] : null,
                    ];
                },
            );
            return successResponse(
                $notifications,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function post(Request $request)
    {
        try {
            NotificationToken::updateOrCreate(
                ['device_id' => $request->device_id],
                [
                    'city_id' => $request->city_id,
                    'fcm_token' => $request->fcm_token,
                ]
            );
            return successResponse();
        } catch (\Exception $e) {
            return failureResponse($e->getMessage());
        }
    }
}
