<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    public $timestamps = false;
    protected $fillable = ['origin','dest','distance'];
}
