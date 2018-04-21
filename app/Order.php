<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $fillable = ['orderNumber','quantity','customer','berat','deliveryDate','keterangan','status'];    
}
