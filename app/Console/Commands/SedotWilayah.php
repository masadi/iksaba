<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class SedotWilayah extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sedot:wilayah';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api_key = '6d1cae89a9a54d677e998a3890fbcc7f106971b9e2d2877c6d5e2bec06036188';
        $response = Http::get('https://api.binderbyte.com/wilayah/provinsi', [
            'api_key' => $api_key,
        ]);
        Storage::disk('public')->put('provinsi.json', json_encode($response->json()));
        $all_provinsi = $response->json();
        foreach($all_provinsi['value'] as $provinsi){
            $get_kabupaten = Http::get('https://api.binderbyte.com/wilayah/kabupaten', [
                'api_key' => $api_key,
                'id_provinsi' => $provinsi['id']
            ]);
            Storage::disk('public')->put('kabupaten-'.$provinsi['id'].'.json', json_encode($get_kabupaten->json()));
            $all_kabupaten = $get_kabupaten->json();
            foreach($all_kabupaten['value'] as $kabupaten){
                $get_kecamatan = Http::get('https://api.binderbyte.com/wilayah/kecamatan', [
                    'api_key' => $api_key,
                    'id_kabupaten' => $kabupaten['id']
                ]);
                Storage::disk('public')->put('kecamatan-'.$kabupaten['id'].'.json', json_encode($get_kecamatan->json()));
                $all_kecamatan = $get_kecamatan->json();
                foreach($all_kecamatan['value'] as $kecamatan){
                    $get_desa = Http::get('https://api.binderbyte.com/wilayah/kelurahan', [
                        'api_key' => $api_key,
                        'id_kecamatan' => $kecamatan['id']
                    ]);
                    Storage::disk('public')->put('desa-'.$kecamatan['id'].'.json', json_encode($get_desa->json()));
                }
            }
        }
    }
}
