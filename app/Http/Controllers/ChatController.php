<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');
        
        if (!$message) {
            return response()->json(['reply' => 'Vui lòng nhập tin nhắn.']);
        }

        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json(['reply' => 'Tính năng Chatbot đang bảo trì (Thiếu API Key).']);
        }

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey;

        // Context cho trợ lý ảo
        $systemContext = "Bạn là một trợ lý ảo hỗ trợ khách hàng cho một trang web đặt tour du lịch có tên là TravelBooking. 
Bạn cần trả lời lịch sự, thân thiện và ngắn gọn. 
Nếu khách hàng hỏi về tour, hãy gợi ý họ tìm kiếm trên trang chủ.
Nếu khách hỏi chính sách hoàn hủy, hãy nói rằng có thể hủy trước 3 ngày.
Tin nhắn của khách: ";

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemContext . $message]
                    ]
                ]
            ]
        ];

        try {
            $response = Http::post($url, $payload);
            
            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi không thể trả lời lúc này.';
                
                // Format reply for markdown basic if needed
                return response()->json(['reply' => $reply]);
            } else {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json(['reply' => 'Lỗi từ Gemini: ' . $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('Chatbot Exception: ' . $e->getMessage());
            return response()->json(['reply' => 'Đã xảy ra lỗi hệ thống.']);
        }
    }
}
