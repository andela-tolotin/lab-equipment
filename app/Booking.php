<?php

namespace LabEquipment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'session',
        'user_id',
        'lab_id',
        'equipment_id',
        'time_slot',
        'booking_date',
    ];

    /**
     * Always json_decode time_slot so they are usable
     */
    public function getTimeSlotAttribute($value) {
        return json_decode($value);

        // you could always make sure you get an array returned also
        // return json_decode($value, true);
    }

    /**
     * Always json_encode the time_slot when saving to the database
     */
    public function setTimeSlotAttribute($value) {
        $this->attributes['time_slot'] = json_encode($value);
    }
    
    public function user()
    {
    	return $this->belongsTo('LabEquipment\User');
    }

    public function training()
    {
    	return $this->hasOne('LabEquipment\Training');
    }

    public function equipment()
    {
        return $this->belongsTo('LabEquipment\Equipment');
    }
}
