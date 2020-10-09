<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJabatanOrganisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatan_organisasi', function (Blueprint $table) {
            $table->uuid('jabatan_organisasi_id');
            $table->uuid('santri_id');
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade');
            $table->decimal('tmt', 4, 0);
            $table->decimal('tst', 4, 0);
            $table->timestamps();
            $table->foreign('santri_id')->references('santri_id')->on('santri')->onDelete('cascade');
            $table->foreign('tmt')->references('tahun_id')->on('tahun')->onDelete('cascade');
            $table->foreign('tst')->references('tahun_id')->on('tahun')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jabatan_organisasi');
    }
}
