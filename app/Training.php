<?php

namespace LabEquipment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'date_of_training_session',
        'location',
        'booking_id',
     ];
    
    public function user()
    {
        return $this->belongs('LabEquipment\User');
    }
    
    public function booking()
    {
    	return $this->belongsTo('LabEquipment\Booking');
    }
}
