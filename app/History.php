<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;
    protected $fillable = ['rute', 'totalJarak', 'totalBerat', 'deliveryDate', 'keterangan', 'namaTruck'];

}
