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
        Schema::create('akesehatan', function (Blueprint $table) {
            $table->bigIncrements('id_arkes');
            $table->unsignedBigInteger('user_id');
            $table->string('kategori');
            $table->string('nama_arkes');
            $table->string('deskripsi_arkes')->nullable();
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
        Schema::dropIfExists('akesehatan');
    }
};
