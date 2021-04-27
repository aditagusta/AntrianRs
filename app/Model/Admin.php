<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Admin extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $guard = 'admin';
    public $timestamps = false;
    // define table
    protected $table = 'admin';
    // define primary key
    protected $primaryKey = 'id_admin';
    // define field
    protected $fillable = ['username', 'password', 'nama_admin'];
}
