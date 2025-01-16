<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\City;
use Illuminate\Support\Facades\Http;
use App\Models\NotificationToken;

class ExternalNotificationsDashController extends Controller
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
                return $this->deleteFile(
                    $request,
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

    public function post(
        Request $request,
    ) {
        try {
            $tokens = $request->tokens;
            $title = $request->title;
            $body = $request->body;
            $notificationData = [
                'message' => [
                    'token' => $tokens,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'android' => [
                        'priority' => 'HIGH',
                    ],
                ]
            ];
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('FCM_SERVER_KEY'), // استخدام FCM server key من .env
            ];
            $response = Http::withHeaders($headers)
                ->post('https://fcm.googleapis.com/v1/projects/YOUR_PROJECT_ID/messages:send', $notificationData);

            if ($response->successful()) {
                return response()->json(['message' => 'Notification sent successfully!']);
            } else {
                return response()->json(['message' => 'Failed to send notification', 'error' => $response->body()], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}
