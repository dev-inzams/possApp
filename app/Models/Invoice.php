<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model {
    use HasFactory;
    protected $fillable = ['total', 'discount', 'vat', 'payable', 'user_id', 'customer_id'];

    public function customer(): BelongsTo {
        return $this->belongsTo( Customer::class );
    }

    public function invoice_product() {
        return $this->hasMany( InvoiceProduct::class );
    }
}
