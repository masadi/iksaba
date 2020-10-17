<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Santri;
use App\Tahun;
use Validator;
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
        $all_data = Santri::with(['provinsi', 'kabupaten', 'kecamatan', 'desa', 'pekerjaan', 'asrama'])->orderBy(request()->sortby, request()->sortbydesc)->whereNull('tahun_keluar')
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
    public function get_alumni(Request $request)
    {
        $all_data = Santri::with(['provinsi', 'kabupaten', 'kecamatan', 'desa', 'pekerjaan', 'asrama'])->orderBy(request()->sortby, request()->sortbydesc)->whereNotNull('tahun_keluar')
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
        $messages = [
            'nama.required' => 'Nama lengkap harus di isi',
            'nik.required' => 'NIK harus di isi',
            'nik.unique' => 'NIK sudah terdaftar',
            'tempat_lahir.required' => 'Tempat Lahir harus di isi',
            'tanggal_lahir.required' => 'Tanggal Lahir harus di isi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus di isi',
            'alamat.required' => 'Alamat harus di isi',
            'provinsi_id.required' => 'Provinsi tidak boleh kosong',
            'kabupaten_id.required' => 'Kabupaten/Kota tidak boleh kosong',
            'kecamatan_id.required' => 'Kecamatan tidak boleh kosong',
            'desa_id.required' => 'Desa/Kelurahan tidak boleh kosong',
            'pekerjaan_id.required' => 'Pekerjaan tidak boleh kosong',
            'asrama_id.required' => 'Asrama tidak boleh kosong',
            'tahun_masuk.required' => 'Tahun Masuk tidak boleh kosong',
		];
		$validator = Validator::make(request()->all(), [
            'nama' => 'required',
            'nik' => 'required|unique:santri',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
            'desa_id' => 'required',
            'pekerjaan_id' => 'required',
            'asrama_id' => 'required',
            'tahun_masuk' => 'required',
		 ],
		$messages
        )->validate();
        Tahun::updateOrCreate(
            ['tahun_id' => $request->tahun_masuk],
            ['nama' => 'Tahun '.$request->tahun_masuk]
        );
        if($request->tahun_keluar){
            Tahun::updateOrCreate(
                ['tahun_id' => $request->tahun_keluar],
                ['nama' => 'Tahun '.$request->tahun_keluar]
            ); 
        }
        $data = Santri::create($request->all());
        return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Data santri berhasil disimpan']);
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
