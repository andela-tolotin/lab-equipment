<?php

namespace LabEquipment;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'student_id', 'office_location', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bookings()
    {
        return $this->hasMany('LabEquipment\Booking');
    }

    public function notifications()
    {
        return $this->hasMany('LabEquipment\NotifiedUser');
    }

    public function roles()
    {
        return $this->hasMany('LabEquipment\Role');
    }
}
