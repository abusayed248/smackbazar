<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'address_en',
        'address_bn',
        'phone_en',
        'phone_bn',
        'email',
        'suport_email',
        'site_logo',
        'site_favicon',
    ];
}
