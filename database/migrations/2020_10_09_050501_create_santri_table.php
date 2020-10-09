<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->uuid('santri_id');
            $table->string('nama');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade')->nullable();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->onDelete('cascade')->nullable();
            $table->foreignId('kabupaten_id')->constrained('kabupaten')->onDelete('cascade')->nullable();
            $table->foreignId('provinsi_id')->constrained('provinsi')->onDelete('cascade')->nullable();
            $table->string('nomor_hp');
            $table->string('email')->nullable();
            $table->foreignId('pekerjaan_id')->constrained('pekerjaan')->onDelete('cascade')->nullable();
            $table->foreignId('pendidikan_id')->constrained('pendidikan')->onDelete('cascade')->nullable();
            $table->foreignId('asrama_id')->constrained('asrama')->onDelete('cascade')->nullable();
            $table->decimal('tahun_masuk', 4, 0);
            $table->decimal('tahun_keluar', 4, 0)->nullable();
            $table->timestamps();
            $table->foreign('tahun_masuk')->references('tahun_id')->on('tahun')->onDelete('cascade');
            $table->foreign('tahun_keluar')->references('tahun_id')->on('tahun')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('santri');
    }
}
