<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apendidikan', function (Blueprint $table) {
            $table->uuid('id_arpen')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('kategori');
            $table->string('jenjang');
            $table->string('nama_arpen');
            $table->string('deskripsi_arpen');
            $table->string('url');
            $table->string('hashname');
            $table->bigInteger('kk')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apendidikan');
    }
};
