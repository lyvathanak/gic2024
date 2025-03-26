<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_date',
        'total_price',
        'customer_id',
    ];

    protected $dates = ['deleted_at'];

    protected function orderDate(): Attribute
    {
        return Attribute::make(
            // Mutator: Convert DD/MM/YYYY HH:MM:SS to Y-m-d H:i:s before saving
            set: fn ($value) => Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d H:i:s'),

            // Accessor: Convert Y-m-d H:i:s to DD/MM/YYYY HH:MM:SS when retrieving
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y H:i:s'),
        );
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}