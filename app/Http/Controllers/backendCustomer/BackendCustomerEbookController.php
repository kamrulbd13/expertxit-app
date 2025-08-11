<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\EbookPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendCustomerEbookController extends Controller
{
    //index
    public function index()
    {
        return view('backendCustomer.ebook.index', [
            'ebooks' => Ebook::all(),
        ]);
    }

    public function details($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('backendCustomer.ebook.details', compact('ebook'));
    }

//    show purchase
    public function showPurchaseForm($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('backendCustomer.ebook.purchase', compact('ebook'));
    }

//    purchase
    public function confirmPurchase(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $ebook = Ebook::findOrFail($id);

        // Check if already purchased
        $alreadyPurchased = EbookPurchase::where('customer_id', $customer->id)
            ->where('ebook_id', $ebook->id)
            ->exists();

        if ($alreadyPurchased) {
            $purchase = EbookPurchase::where('customer_id', $customer->id)
                ->where('ebook_id', $ebook->id)
                ->latest()
                ->first();

            return view('backendCustomer.ebook.already_purchased', compact('ebook', 'purchase'));
        }

        // Validate payment info if price > 0
        if ($ebook->price > 0) {
            $request->validate([
                'sender_account' => 'required|string|max:100',
                'transaction_id' => 'required|string|max:100',
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'note' => 'nullable|string|max:500',
            ]);

            $image = $request->file('payment_proof');
            $extension = $image->extension();
            $imageName = 'payment-proof-' . uniqid() . '.' . $extension;
            $directory = 'backend/images/paymentProofs/';

            // Move image to public folder
            $image->move(public_path($directory), $imageName);

            $paymentProofPath = $directory . $imageName;  // store this path in DB
        } else {
            $paymentProofPath = null;
        }

        // Save purchase record
        EbookPurchase::create([
            'customer_id' => $customer->id,
            'ebook_id' => $ebook->id,
            'price_paid' => $ebook->price,
            'sender_account' => $request->input('sender_account'),
            'transaction_id' => $request->input('transaction_id'),
            'payment_proof' => $paymentProofPath,
            'note' => $request->input('note'),
            'purchased_at' => now(),
        ]);

//        return redirect()->route('ebook.index')->with('message', 'Purchase successful! Your payment is under verification.');
        return redirect()->route('ebooks.purchase.success', $ebook->id)->with('message', 'Purchase successful! Your payment is under verification.');

    }

//    purchase success
    public function purchaseSuccess($id)
    {
        $customer = Auth::guard('customer')->user();
        $ebook = Ebook::findOrFail($id);

        // Get the last purchase record for this user and ebook
        $purchase = EbookPurchase::where('customer_id', $customer->id)
            ->where('ebook_id', $ebook->id)
            ->latest()
            ->first();

        return view('backendCustomer.ebook.purchase_success', compact('ebook', 'purchase'));
    }




}
