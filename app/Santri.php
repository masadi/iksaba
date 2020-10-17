<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
class Santri extends Model
{
    use Uuid;
	public $incrementing = false;
    protected $keyType = 'string';
	protected $table = 'santri';
	protected $primaryKey = 'santri_id';
    protected $guarded = [];
    public function provinsi()
    {
        return $this->hasOne('App\Provinsi', 'id', 'provinsi_id');
    }
    public function kabupaten()
    {
        return $this->hasOne('App\Kabupaten', 'id', 'kabupaten_id');
    }
    public function kecamatan()
    {
        return $this->hasOne('App\Kecamatan', 'id', 'kecamatan_id');
    }
    public function desa()
    {
        return $this->hasOne('App\Desa', 'id', 'desa_id');
    }
    public function pekerjaan()
    {
        return $this->hasOne('App\Pekerjaan', 'id', 'pekerjaan_id');
    }
    public function asrama()
    {
        return $this->hasOne('App\Asrama', 'id', 'asrama_id');
    }
}
