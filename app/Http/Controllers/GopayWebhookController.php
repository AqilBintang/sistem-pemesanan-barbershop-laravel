<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GopayService;
use Illuminate\Support\Facades\Log;

class GopayWebhookController extends Controller
{
    protected $gopayService;

    public function __construct(GopayService $gopayService)
    {
        $this->gopayService = $gopayService;
    }

    /**
     * Handle GoPay webhook notification
     */
    public function handleWebhook(Request $request)
    {
        Log::info('GoPay Webhook Received', [
            'headers' => $request->headers->all(),
            'payload' => $request->all()
        ]);

        try {
            $payload = $request->all();
            
            // Process webhook
            $result = $this->gopayService->handleWebhook($payload);
            
            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Webhook processed successfully'
                ], 200);
            }
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process webhook'
            ], 400);

        } catch (\Exception $e) {
            Log::error('GoPay Webhook Error', [
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
            'transaction_id' => 'required|string'
        ]);

        try {
            $result = $this->gopayService->checkPaymentStatus($request->transaction_id);
            
            return response()->json($result);

        } catch (\Exception $e) {
            Log::error('Payment Status Check Error', [
                'message' => $e->getMessage(),
                'transaction_id' => $request->transaction_id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengecek status pembayaran'
            ], 500);
        }
    }
}