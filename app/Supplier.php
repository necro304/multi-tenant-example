<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use UsesTenantConnection;
    protected $fillable = ['nama','alamat','email','telepon'];

    protected $hidden = ['created_at','updated_at'];
}
