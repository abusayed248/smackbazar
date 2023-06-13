<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id','subcat_id','caste_id','garden_id','admin_id','p_name_en','p_name_bn','p_slug_en','p_slug_bn','p_code','p_description_en','p_description_bn','regular_price','discount_price','unit','stock_qty','yt_video_code','thumbnail','images','p_views','status','slider','hot_deal','today_deal','featured','trendy',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function subcat()
    {
        return $this->belongsTo(Subcat::class, 'subcat_id', 'id');
    }

    public function garden()
    {
        return $this->belongsTo(Garden::class, 'garden_id', 'id');
    }

    public function caste()
    {
        return $this->belongsTo(Fruitcaste::class, 'caste_id', 'id');
    }

    protected $casts = [
        'status'        => 'boolean',
        'slider'        => 'boolean',
        'hot_deal'      => 'boolean',
        'today_deal'    => 'boolean',
        'featured'      => 'boolean',
        'trendy'        => 'boolean',
    ];
}
