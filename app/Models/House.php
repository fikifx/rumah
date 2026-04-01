<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'price',
        'status',
        'beds',
        'baths',
        'area',
        'is_new',
        'image',
        'description',
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'beds' => 'integer',
        'baths' => 'integer',
        'area' => 'integer',
    ];
}
