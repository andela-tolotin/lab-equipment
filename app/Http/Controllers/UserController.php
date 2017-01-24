<?php

namespace LabEquipment\Http\Controllers;

use Auth;
use LabEquipment\Lab;
use LabEquipment\User;
use LabEquipment\Equipment;
use LabEquipment\Booking;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

class UserController extends Controller
{
    public function createTrainingRequest(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'student_id' => $request->student_id,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if (count($user) > 0) {
            $booking = Booking::create([
                'user_id' => $user->id,
                'equipment_id' => $request->equipment,
                'time_slot' => $request->time_slot,
                'booking_date' => date_format($date, 'Y-m-d H:i:s'),
            ]);
        }

        return view('student.training_request_confirmation');
    }

    public function requestForm()
    {
        $labs = Lab::findAll();
        return view('student.request_training', compact('labs'));
    }

    public function changePassword(Request $request, $email)
    {
        $user = User::findOneByEmail($email);
        $oldPassword = $request->c_password;
        $newPassword = $request->new_password;

        if (count($user) > 0) {
            if (\Hash::check($oldPassword, $user->getAuthPassword())) {
                $user->password = bcrypt($newPassword);
                $user->save();
            }

            return response()->json([
                'message' => 'Your password has been updated successfully'
            ]);
        }

        return response()->json(['message' => 'Error updating password']);
    }

    public function viewMyProfile()
    {
        $equipments = Equipment::findAll();
        $bookings =  $this->showMyBookingHistory();

        return view('student.my_profile', compact('equipments', 'bookings'));
    }

    protected function showMyBookingHistory()
    {
        $user = Auth::user();

        return Booking::findOneByEquipment($user->id);
    }

    public function editUserInfo(Request $request, $email)
    {
        $name = $request->name;
        $email = $request->email;
        $office = $request->office;
        $phone = $request->phone;
        $oldPassword = $request->c_password;
        $newPassword = $request->new_password;
        // use the email address to find the record
        $user = User::findOneByEmail($email);

        if (count($user) > 0) {
            if (\Hash::check($oldPassword, $user->getAuthPassword())) {
                $user->name = $name;
                $user->email = $email;
                $user->office_location = $office;
                $user->phone = $phone;
                $user->password = bcrypt($newPassword);
                $user->save();
            } 
            return response()->json(['message' => 'Record updated successfully']);
        }
        return response()->json(['message' => 'Error updating record']);
    }

    public function editUserAccount(Request $request, $userId)
    {
        $user = User::findOneByIdWithTrashed($userId);

        if (is_null($user)) {
            return response()->json(['message' => 'Account De-activated'], 200);
        }
        //return response()->json($user, 200);
        return view('admin.manage_user_account.update_user_account', 
            compact('user')
        );
    }

    public function updateUserAccount(Request $request, $userId)
    {
        $user = User::findOneByIdWithTrashed($userId);

        if (!is_null($user)) {
            $user->email = $request->email;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->office_location = $request->office;
            $user->student_id = $request->student_id;
            $user->role_id = $request->role;

            $status = $request->status == 0? $user->destroy($user->id): $user->restore();

            $user->save();

            // For Equipment
            $equipments = $request->equipment;
            $equipmentId = $request->equipment_id;
            $equipmentIds = explode('##', $equipmentId);

            if (count($equipments) > 0) {
                foreach($equipments as $index => $equipment) {
                    $labEquipment = Equipment::findOneByIdWithTrashed($equipmentIds[$index]);
                    if ($equipments[$index] == 0) {
                        $labEquipment->destroy($labEquipment->id);
                    } else {
                        $labEquipment->restore();
                    }
                }
            }

            return response()->json(['message' => 'User Account updated successfully'], 200);
        }
        return response()->json(['message' => 'Error updating user Account'], 400);
    }

    public function gettUserStatus(Request $request, $status)
    {
        if ($status == 0) {
            $users = User::where('deleted_at', '!=', NULL)->get();
            if ($users->count() > 0) {
                return response()->json($users, 200);
            }
        } else {
            $users = User::FindAll();
            if ($users->count() > 0) {
                return response()->json($users, 200);
            }
        }

        return response()->json(['message' => 'Users not found'], 404);
    }
}
