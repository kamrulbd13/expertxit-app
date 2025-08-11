<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbookPurchase extends Model
{
    protected $fillable = [
        'ebook_id',
        'customer_id',
        'price_paid',
        'payment_method',
        'sender_account',
        'transaction_id',
        'payment_proof',
        'note',
        'purchased_at',
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
    ];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
