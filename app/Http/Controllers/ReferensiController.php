<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use App\Pekerjaan;
use App\Pendidikan;
use App\Asrama;
class ReferensiController extends Controller
{
    public function get_provinsi(Request $request){
        $all_data = Provinsi::pluck('nama', 'id');
        $response = [
            'success' => true,
            'data'    => $all_data,
        ];
        return response()->json($response, 200);
    }
    public function get_kabupaten(Request $request){
        $all_data = Kabupaten::where('provinsi_id', $request->provinsi_id)->pluck('nama', 'id');
        $response = [
            'success' => true,
            'data'    => $all_data,
        ];
        return response()->json($response, 200);
    }
    public function get_kecamatan(Request $request){
        $all_data = Kecamatan::where('kabupaten_id', $request->kabupaten_id)->pluck('nama', 'id');
        $response = [
            'success' => true,
            'data'    => $all_data,
        ];
        return response()->json($response, 200);
    }
    public function get_desa(Request $request){
        $all_data = Desa::where('kecamatan_id', $request->kecamatan_id)->pluck('nama', 'id');
        $response = [
            'success' => true,
            'data'    => $all_data,
        ];
        return response()->json($response, 200);
    }
    public function get_pekerjaan(Request $request){
        $all_data = Pekerjaan::pluck('nama', 'id');
        $response = [
            'success' => true,
            'data'    => $all_data,
        ];
        return response()->json($response, 200);
    }
    public function get_pendidikan(Request $request){
        $all_data = Pendidikan::pluck('nama', 'id');
        $response = [
            'success' => true,
            'data'    => $all_data,
        ];
        return response()->json($response, 200);
    }
    public function get_asrama(Request $request){
        $is_putra = ($request->jenis_kelamin == 'L') ? 1 : 0;
        $all_data = Asrama::where('is_putra', $is_putra)->pluck('nama', 'id');
        $response = [
            'success' => true,
            'data'    => $all_data,
        ];
        return response()->json($response, 200);
    }
}
