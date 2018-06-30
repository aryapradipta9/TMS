<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moda extends Model
{
    public $timestamps = false;
    protected $fillable = ['nama','vendor','quantity','plat','tonase','duration','startFrom','endTo','status','contact'];
}
