<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $fillable = ['nama','jenis','alamat','mail','no_telp','contact_person', 'kecamatan', 'kabupaten', 'provinsi'];
}
