<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->id('id_member');
            $table->string('username');
            $table->string('password');
            $table->string('password1');
            $table->string('nama_member');
            $table->string('pangkat');
            $table->string('satuan_kerja');
            $table->string('lahir');
            $table->text('alamat');
            $table->enum('jenis_kelamin',['Permpuan','Pria']);
            $table->string('bpjs');
            $table->enum('pasien',['Militer','PNS','Keluarga Militer','Keluarga PNS','BPJS','Non BPJS']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
