<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Category extends Model
{
    use UsesTenantConnection;
    protected $fillable = ['name'];
}
