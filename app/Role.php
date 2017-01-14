<?php

namespace LabEquipment;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = ['role'];

    public function user()
    {
    	return $this->belongsTo('LabEquipment\User')
    }
}
