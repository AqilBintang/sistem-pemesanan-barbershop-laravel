<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Handle Midtrans notification webhook
     */
    public function handleNotification(Request $request)
    {
        Log::info('Midtrans Notification Received', [
            'headers' => $request->headers->all(),
            'payload' => $request->all()
        ]);

        try {
            $notification = $request->all();
            
            // Process notification
            $result = $this->midtransService->handleNotification($notification);
            
            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Notification processed successfully'
                ], 200);
            }
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process notification'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Internal server error'
            ], 500);
        }
    }

    /**
     * Check payment status manually
     */
    public function checkPaymentStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string'
        ]);

        try {
            $result = $this->midtransService->checkPaymentStatus($request->order_id);
            
            return response()->json($result);

        } catch (\Exception $e) {
            Log::error('Midtrans Status Check Error', [
                'message' => $e->getMessage(),
                'order_id' => $request->order_id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengecek status pembayaran'
            ], 500);
        }
    }
}