<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cat_name_en',
        'cat_name_bn',
        'cat_slug_bn',
        'cat_slug_en',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
