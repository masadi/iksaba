<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('logo')->nullable();
            $table->foreignId('tingkat_organisasi_id')->constrained('tingkat_organisasi')->onDelete('cascade');
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade')->nullable();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->onDelete('cascade')->nullable();
            $table->foreignId('kabupaten_id')->constrained('kabupaten')->onDelete('cascade')->nullable();
            $table->foreignId('provinsi_id')->constrained('provinsi')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisasi');
    }
}
