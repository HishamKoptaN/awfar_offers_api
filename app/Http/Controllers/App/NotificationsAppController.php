<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsAppController extends Controller
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
                return $this->store(
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
}
