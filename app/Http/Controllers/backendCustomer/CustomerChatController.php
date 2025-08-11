<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CustomerChatController extends Controller
{
    public function fetchMessages(Request $request)
    {
        $customerId = Auth::guard('customer')->id();
        $adminId = $request->input('admin_id', 1); // default admin ID

        $messages = ChatMessage::with('from')
            ->where(function ($q) use ($adminId, $customerId) {
                $q->where('from_id', $customerId)
                    ->where('from_type', 'customer')
                    ->where('to_id', $adminId)
                    ->where('to_type', 'admin');
            })
            ->orWhere(function ($q) use ($adminId, $customerId) {
                $q->where('from_id', $adminId)
                    ->where('from_type', 'admin')
                    ->where('to_id', $customerId)
                    ->where('to_type', 'customer');
            })
            ->orderBy('created_at')
            ->get();

        $messages->transform(function ($msg) {
            $from = $msg->from;

            // Sender name fallback
            $msg->from_name = $from->name ?? 'Unknown';

        // Valid image check
        $msg->from_image_url = null;
        if ($from && $from->image_path) {
            if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $from->image_path)) {
                $msg->from_image_url = str_starts_with($from->image_path, 'http')
                    ? $from->image_path
                    : asset($from->image_path);
            }
        }

        // Only set letter if no valid image
        $msg->from_avatar_letter = !$msg->from_image_url
            ? strtoupper(substr($msg->from_name, 0, 1))
            : null;

        // File (if image)
        $msg->file_url = ($msg->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $msg->file_path))
            ? asset($msg->file_path)
            : null;

        return $msg;
    });

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // max 10MB
            'to_id' => 'required|integer',
            'to_type' => 'required|string|in:admin,customer',
        ]);

        $customerId = Auth::guard('customer')->id();

        $data = [
            'from_id' => $customerId,
            'from_type' => 'customer',
            'to_id' => $request->to_id,
            'to_type' => $request->to_type,
            'message' => $request->message,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('chat_files');
            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getMimeType();
        }

        ChatMessage::create($data);

        return response()->json(['status' => 'success']);
    }


}
