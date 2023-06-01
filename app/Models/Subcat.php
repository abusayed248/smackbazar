<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cat_id',
        'subcat_name_en',
        'subcat_name_bn',
        'subcat_slug_bn',
        'subcat_slug_en',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
