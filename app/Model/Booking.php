<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'booking';
    // define primary key
    protected $primaryKey = 'id_booking';
    // define field
    protected $fillable = ['id_member', 'pelayanan', 'tanggal_booking'];
}
