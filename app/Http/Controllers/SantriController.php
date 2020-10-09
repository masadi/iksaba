<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Santri;
class SantriController extends Controller
{
    public function index(){
        $data = Santri::limit(10)->orderBy('created_at', 'DESC')->get();
        $counting = [
            'santri_putra' => Santri::where(function($query){
                $query->where('jenis_kelamin', 'L');
                $query->whereNull('tahun_keluar');
            })->count(),
            'santri_putri' => Santri::where(function($query){
                $query->where('jenis_kelamin', 'L');
                $query->whereNull('tahun_keluar');
            })->count(),
            'alumni_putra' => Santri::where(function($query){
                $query->where('jenis_kelamin', 'L');
                $query->whereNotNull('tahun_keluar');
            })->count(),
            'alumni_putri' => Santri::where(function($query){
                $query->where('jenis_kelamin', 'L');
                $query->whereNotNull('tahun_keluar');
            })->count(),
        ];
        return response()->json(['status' => 'success', 'data' => $data, 'counting' => $counting]);
    }
}
