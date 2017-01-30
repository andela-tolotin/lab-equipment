<?php

namespace LabEquipment\Http\Controllers;

use Auth;
use LabEquipment\Lab;
use LabEquipment\User;
use LabEquipment\Booking;
use LabEquipment\Training;
use LabEquipment\Equipment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = $this->showMyBookingHistory();
        $users = User::findAllWithTrashed();
        $adminUsers = User::FindAllAdmin();
        $labs = Lab::findAll();
        $equipments = Equipment::findAll();

        $training = Training::where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        //dd($training);

        return view('admin.admin', compact(
            'users', 'labs', 'equipments', 'adminUsers', 'bookings'
        ));
    }

    protected function showMyBookingHistory()
    {
        return Booking::findOneByEquipment(Auth::user()->id);
    }
}
