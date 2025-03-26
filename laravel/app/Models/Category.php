<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import the SoftDeletes trait

class Category extends Model
{
    use HasFactory, SoftDeletes; // Use the SoftDeletes trait

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}