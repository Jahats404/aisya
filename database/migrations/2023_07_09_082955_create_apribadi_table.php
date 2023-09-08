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
        Schema::create('apribadi', function (Blueprint $table) {
            $table->uuid('id_arpri')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('kategori');
            $table->string('nama_arpri');
            $table->string('deskripsi_arpri');
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
        Schema::dropIfExists('apribadi');
    }
};
