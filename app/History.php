<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;
    protected $fillable = ['orderNumber', 'totalJarak', 'totalBerat', 'deliveryDate', 'keterangan', 'truck', 'groupId'];

}
