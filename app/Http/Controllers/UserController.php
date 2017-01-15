<?php

namespace LabEquipment\Http\Controllers;

use Illuminate\Http\Request;
use LabEquipment\User;

class UserController extends Controller
{
	public function editUserInfo(Request $request)
	{
		$name = $request->name;
		$email = $request->email;
		$office = $request->office;
		$password = bcrypt($request->new_password);
		// use the email address to find the record
		$user = User::findOneByEmail($email);

		if (count($user) > 0) {
			return response()->json(['message' => 'Record updated successfully']);
		}
		return response()->json(['message' => 'Error updating record']);
	}
}
