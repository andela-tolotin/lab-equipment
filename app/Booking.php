<?php

namespace LabEquipment;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    //
}
