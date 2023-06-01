<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'garden_name_en',
        'garden_name_bn',
        'garden_location_en',
        'garden_location_bn',
        'garden_image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
