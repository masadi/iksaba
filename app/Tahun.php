<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
	protected $table = 'tahun';
	protected $primaryKey = 'tahun_id';
	protected $guarded = [];
}
