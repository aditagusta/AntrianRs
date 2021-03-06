<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Member extends Model implements AuthenticatableContract,JWTSubject
{
    use Authenticatable;
    public $timestamps = false;
    // define table
    protected $table = 'member';
    // define primary key
    protected $primaryKey = 'id_member';
    // define field
    protected $fillable = ['username', 'password', 'password1', 'nama_member', 'pangkat', 'satuan_kerja', 'lahir','alamat','jenis_kelamin','bpjs','pasien'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
