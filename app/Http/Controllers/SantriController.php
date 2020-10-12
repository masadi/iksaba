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
    public function get_santri(Request $request)
    {
        $all_data = Santri::orderBy(request()->sortby, request()->sortbydesc)->whereNull('tahun_keluar')
            ->when(request()->q, function($berita) {
                $all_data = $all_data->where('nama', 'LIKE', '%' . request()->q . '%')
                ->orWhere('alamat', 'LIKE', '%' . request()->q . '%')
                ->orWhereIn('kabupaten_id', function($query){
                    $query->select('id')->from('kabupaten')->where('nama', 'LIKE', '%' . request()->q . '%');
                })
                ->orWhere('tahun_masuk', 'LIKE', '%' . request()->q . '%')
                ->orWhere('tahun_keluar', 'LIKE', '%' . request()->q . '%');
        })->paginate(request()->per_page); //KEMUDIAN LOAD PAGINATIONNYA BERDASARKAN LOAD PER_PAGE YANG DIINGINKAN OLEH USER
        return response()->json(['status' => 'success', 'data' => $all_data]);
    }
    public function store(Request $request)
    {
        dd($request->all());
        $user = User::find($request->user_id);
        if(!$user){
            return redirect('login');
        }
        $data = NULL;
        if($user->hasRole('sekolah')){
            $data = HelperModel::rapor_mutu($request->user_id);
        } elseif($user->hasRole('penjamin_mutu')){
            $data = [
                'jml_sekolah_sasaran' => Sekolah::whereHas('sekolah_sasaran', function($query) use ($request){
                    $query->where('verifikator_id', $request->user_id);
                })->count(),
                'jml_sekolah_sasaran_instrumen' => Sekolah::whereHas('sekolah_sasaran', function($query) use ($request){
                    $query->where('verifikator_id', $request->user_id);
                    $query->has('pakta_integritas');
                })->count(),
                'jml_sekolah_sasaran_no_instrumen' => Sekolah::whereHas('sekolah_sasaran', function($query) use ($request){
                    $query->where('verifikator_id', $request->user_id);
                    $query->doesntHave('pakta_integritas');
                })->count(),
                'jml_sekolah_sasaran_verval' => Sekolah::whereHas('sekolah_sasaran', function($query) use ($request){
                    $query->where('verifikator_id', $request->user_id);
                    $query->has('rapor_mutu');
                })->count(),
            ];
        }
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
