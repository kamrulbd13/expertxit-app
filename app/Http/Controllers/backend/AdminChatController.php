<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Customer;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminChatController extends Controller
{

    // Show the admin chat panel view with customers
    public function index()
    {
        $customers = Customer::orderBy('last_seen_at','desc')->get(); // get all customers for the list
        return view('backend.customerChat.chat', compact('customers'));
    }



    // Fetch messages with a customer
//    public function fetchMessages(Customer $customer)
//    {
//        if (!Auth::guard('admin')->check()) {
//            return response()->json(['error' => 'Unauthorized'], 403);
//        }
//
//        // Get chat messages between admin and customer ordered by time ascending
//        $adminId = Auth::guard('admin')->id();
//
//        $messages = ChatMessage::where(function ($q) use ($adminId, $customer) {
//            $q->where('from_type', 'admin')->where('from_id', $adminId)->where('to_id', $customer->id);
//        })->orWhere(function ($q) use ($adminId, $customer) {
//            $q->where('from_type', 'customer')->where('from_id', $customer->id)->where('to_id', $adminId);
//        })
//            ->orderBy('created_at')
//            ->get();
//
//        return response()->json($messages);
//    }
//


    public function fetchMessages(Customer $customer)
    {
        if (!Auth::guard('admin')->check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $admin = Auth::guard('admin')->user();

        $messages = ChatMessage::where(function ($q) use ($admin, $customer) {
            $q->where('from_type', 'admin')->where('from_id', $admin->id)->where('to_id', $customer->id);
        })->orWhere(function ($q) use ($admin, $customer) {
            $q->where('from_type', 'customer')->where('from_id', $customer->id)->where('to_id', $admin->id);
        })
            ->orderBy('created_at')
            ->get();

        $messages = $messages->map(function ($msg) {
            $fromType = $msg->from_type;

            if ($fromType === 'admin') {
                $fromUser = \App\Models\User::find($msg->from_id); // Adjust to your admin model
            } else {
                $fromUser = \App\Models\Customer::find($msg->from_id); // Adjust to your customer model
            }

            return [
                'id' => $msg->id,
                'message' => $msg->message,
                'created_at' => $msg->created_at->toDateTimeString(),
                'from_type' => $msg->from_type,
                'from_id' => $msg->from_id,
                'to_id' => $msg->to_id,
                'file_url' => $msg->file_url,
                'file_type' => $msg->file_type,
                'from_name' => $fromUser ? $fromUser->name : 'Unknown',
                'from_avatar_url' => $fromUser && $fromUser->image_path ? asset($fromUser->image_path) : null,
            ];
        });

        return response()->json($messages);
    }







    // Send message from admin to customer
    public function sendMessage(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'to_id' => 'required|exists:customers,id',
            'message' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // 10MB
        ]);

        $adminId = Auth::guard('admin')->id();

        $data = [
            'from_id' => $adminId,
            'from_type' => 'admin',
            'to_id' => $request->to_id,
            'to_type' => 'customer',
            'message' => $request->message,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('chat_files', 'public'); // store in 'storage/app/public/chat_files'
            $data['file_url'] = Storage::url($path);      // generates URL like /storage/chat_files/...
            $data['file_type'] = $file->getMimeType();
        }

        ChatMessage::create($data);

        return response()->json(['success' => true, 'message' => 'Message sent']);


    }






}
