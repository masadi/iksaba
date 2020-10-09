<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
class Jabatan_organisasi extends Model
{
    use Uuid;
	public $incrementing = false;
    protected $keyType = 'string';
	protected $table = 'jabatan_organisasi';
	protected $primaryKey = 'Jabatan_organisasi_id';
    protected $guarded = [];
}
