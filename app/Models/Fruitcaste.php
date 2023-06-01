<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruitcaste extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'caste_name_en',
        'caste_name_bn',
        'caste_slug_bn',
        'caste_slug_en',
        'caste_image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
