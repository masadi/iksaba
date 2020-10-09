<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTingkatOrganisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tingkat_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('pusat', 1, 0)->default(0);
            $table->decimal('provinsi', 1, 0)->default(0);
            $table->decimal('kabupaten', 1, 0)->default(0);
            $table->decimal('kecamatan', 1, 0)->default(0);
            $table->decimal('desa', 1, 0)->default(0);
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
        Schema::dropIfExists('tingkat_organisasi');
    }
}
