<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrasiUser extends Model
{
    protected $table = "registrasi_user";
    public $incrementing = true;
    public $timestamps = true;
}
