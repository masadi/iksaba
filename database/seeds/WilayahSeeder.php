<?php

use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = File::get('database/data/provinsi.json');
        $sql = json_decode($sql);
        foreach($sql->value as $data){
            DB::table('provinsi')->updateOrInsert(
                ['id' => $data->id],
                [
                    'nama' => $data->name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
        $seed_folder = database_path('data');
        $all_files = File::allfiles($seed_folder);
        $all_files = collect($all_files);
        $file_kabupaten = array_filter($all_files->toArray(), function($str){
            return strpos($str->getFilename(), "kabupaten") === 0;
        });
        foreach($file_kabupaten as $kabupaten){
            $sql = json_decode($kabupaten->getContents());
            if($sql){
                foreach($sql->value as $data){
                    DB::table('kabupaten')->updateOrInsert(
                        ['id' => $data->id],
                        [
                            'provinsi_id' => $data->id_provinsi,
                            'nama' => $data->name,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        }
        $file_kecamatan = array_filter($all_files->toArray(), function($str){
            return strpos($str->getFilename(), "kecamatan") === 0;
        });
        foreach($file_kecamatan as $kecamatan){
            $sql = json_decode($kecamatan->getContents());
            if($sql){
                foreach($sql->value as $data){
                    DB::table('kecamatan')->updateOrInsert(
                        ['id' => $data->id],
                        [
                            'kabupaten_id' => $data->id_kabupaten,
                            'nama' => $data->name,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        }
        $file_desa = array_filter($all_files->toArray(), function($str){
            return strpos($str->getFilename(), "desa") === 0;
        });
        foreach($file_desa as $desa){
            $sql = json_decode($desa->getContents());
            if($sql){
                foreach($sql->value as $data){
                    DB::table('desa')->updateOrInsert(
                        ['id' => $data->id],
                        [
                            'kecamatan_id' => $data->id_kecamatan,
                            'nama' => $data->name,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        }
    }
}
