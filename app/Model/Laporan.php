<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $timestamps = false;
    // define table
    protected $table = 'catatan';
    // define primary key
    protected $primaryKey = 'id_catatan';
    // define field
    protected $fillable = ['id_booking', 'catatan1', 'catatan2'];
}
