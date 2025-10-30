<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class FcmTokenController extends Controller
{

    // public function sendToken(Request $request)
    // {
    //     try {
    //         $email = $request->input('email');
    //         $newFcmToken = $request->input('fcmtoken');
    //         $user = User::where('email', $email)->first();

    //         if ($user) {
    //             $user->update(['fcmtoken' => $newFcmToken]);
    //             $userId = $user->id;
    //             $order = Order::where('user_id', $userId)->get();
    //             if ($order) {
    //                 $notificationData = [
    //                     'title' => 'Your Order Notification',
    //                     'body' => 'Your order is ready for delivery!',
    //                 ];
    //                 $response = Http::withHeaders([
    //                     'Authorization' => 'key=AAAAlI42AYc:APA91bEPodqmrmK6_lrw359Mv4oWmWNCdip8YrSZmgpMWKirR72VumV4svZHRhn3kcgkeAvuwKHc5mdaygTfYc-9KGg1ezwG9YFWa_kNACRvdbNlqBu387DqojPZZOTcPAh1qmlnYrUz',
    //                     'Content-Type' => 'application/json',
    //                 ])->post('https://fcm.googleapis.com/fcm/send', [
    //                     'to' => $newFcmToken,
    //                     'notification' => $notificationData,
    //                 ]);

    //                 if ($response->successful()) {
    //                     return response()->json(['message' => 'Notification sent successfully'],200);
    //                 } else {
    //                     return response()->json(['error' => 'Failed to send notification'], $response->status());
    //                 }
    //             } else {
    //                 return response()->json(['error' => 'Order not found for the user'], 404);
    //             }
    //         } else {
    //             return response()->json(['error' => 'User not found'], 404);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error($e);
    //         return response()->json(['error' => 'Internal Server Error'], 500);
    //     }
    // }
    // public function sendToken(Request $request)
    // {
    //     try {
    //         $email = $request->input('email');
    //         $newFcmToken = $request->input('fcmtoken');
    //         $user = User::where('email', $email)->first();
    //         if ($user) {
    //             $user->update(['fcmtoken' => $newFcmToken]);
    //             $userId = $user->id;
    //             if (empty($userId)) {
    //                 return response()->json(['error' => 'No User Found'], 404);
    //             }
    //             foreach ($userId as $order) {
    //                 $response = Http::withHeaders([
    //                     'Authorization' => 'key=AAAAlI42AYc:APA91bEPodqmrmK6_lrw359Mv4oWmWNCdip8YrSZmgpMWKirR72VumV4svZHRhn3kcgkeAvuwKHc5mdaygTfYc-9KGg1ezwG9YFWa_kNACRvdbNlqBu387DqojPZZOTcPAh1qmlnYrUz',
    //                     'Content-Type' => 'application/json',
    //                 ])->post('https://fcm.googleapis.com/fcm/send', [
    //                     'to' => $newFcmToken
    //                 ]);

    //                 if ($response->successful()) {
    //                     return response()->json(['message' => 'FCM Token Created successfully'], 200);
    //                 } else {
    //                     return response()->json(['error' => 'FCM Token Not Created successfully'], $response->status());
    //                 }
    //             };
    //         }
    //     } catch (\Exception $e) {
    //         Log::error($e);
    //         return response()->json(['error' => 'Internal Server Error'], 500);
    //     }
    // }
    public function sendToken(Request $request)
    {
        try {
            $email = $request->input('email');
            $newFcmToken = $request->input('fcmtoken');
            $user = User::where('email', $email)->first();

            if ($user) {
                $user->update(['fcmtoken' => $newFcmToken]);
                return response()->json([
                    'user' => $user,
                    'message' => 'FCM Token updated successfully'
                ], 200);
            } else {
                return response()->json(['error' => 'No User Found'], 404);
            }
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
