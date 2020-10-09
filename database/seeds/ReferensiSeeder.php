<?php

use Illuminate\Database\Seeder;

class ReferensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahun = [
            ['tahun_id' => '2020', 'nama' => 'Tahun 2020', 'periode_aktif' => 1],
            ['tahun_id' => '2021', 'nama' => 'Tahun 2021', 'periode_aktif' => 0],
        ];
        $asrama = [
            ['nama' => 'Daerah A', 'is_putra' => 1],
            ['nama' => 'Daerah B', 'is_putra' => 1],
            ['nama' => 'Daerah C', 'is_putra' => 1],
            ['nama' => 'Daerah D', 'is_putra' => 1],
            ['nama' => 'Daerah E', 'is_putra' => 1],
            ['nama' => 'Daerah F', 'is_putra' => 1],
            ['nama' => 'Daerah G', 'is_putra' => 1],
            ['nama' => 'Daerah A', 'is_putra' => 0],
            ['nama' => 'Daerah B', 'is_putra' => 0],
            ['nama' => 'Daerah C', 'is_putra' => 0],
            ['nama' => 'Daerah D', 'is_putra' => 0],
        ];
        $pekerjaan = [
            ['nama' => "Tidak bekerja"],
            ['nama' => "Nelayan"],
            ['nama' => "Petani"],
            ['nama' => "Peternak"],
            ['nama' => "PNS/TNI/Polri"],
            ['nama' => "Karyawan Swasta"],
            ['nama' => "Pedagang Kecil"],
            ['nama' => "Pedagang Besar"],
            ['nama' => "Wiraswasta"],
            ['nama' => "Wirausaha"],
            ['nama' => "Buruh"],
            ['nama' => "Pensiunan"],
            ['nama' => "Tenaga Kerja Indonesia"],
            ['nama' => "Lainnya"],
        ];
        $pendidikan = [
            ['nama' => "Tidak sekolah"],
            ['nama' => "Putus SD"],
            ['nama' => "SD / sederajat"],
            ['nama' => "SMP / sederajat"],
            ['nama' => "SMA / sederajat"],
            ['nama' => "D1"],
            ['nama' => "D2"],
            ['nama' => "D3"],
            ['nama' => "D4"],
            ['nama' => "S1"],
            ['nama' => "S2"],
            ['nama' => "S3"],
            ['nama' => "Lainnya"],
        ];
        DB::table('tahun')->insert($tahun);
        DB::table('asrama')->insert($asrama);
        DB::table('pekerjaan')->insert($pekerjaan);
        DB::table('pendidikan')->insert($pendidikan);
    }
}
