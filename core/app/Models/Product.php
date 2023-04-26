<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'uid';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'price',
        'main_pic',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->uid = static::generate_uid();
        });
    }

    private static function generate_uid(){
        $uid = Str::random(16);
        if(Product::where('uid',$uid)->count()){
            return static::generate_uid();
        }

        return $uid;
    }
}
