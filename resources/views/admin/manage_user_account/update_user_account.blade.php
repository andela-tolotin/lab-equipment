<form class="form-horizontal user-account" id="{{$user->id}}">
	<div class="form-group">
		<label for="student_id" class="col-sm-2 control-label">Student ID</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="student_id" name="student_id" placeholder="Student ID" value="{{ $user->student_id }}">
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" readonly="readonly">
		</div>
	</div>
	<div class="form-group">
		<label for="phone" class="col-sm-2 control-label">Phone</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $user->phone }}">
		</div>
	</div>
	<div class="form-group">
		<label for="office" class="col-sm-2 control-label">Office</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="office" name="office" placeholder="Office" value="{{$user->office_location }}">
		</div>
		<hr>
	</div>
	<hr>
	<div class="form-group">
		<label for="status" class="col-sm-2 control-label">Account Status</label>
		<div class="col-sm-6">
			<select name="status" id="status" class="form-control" required="required">
				<option value="">Status</option>
				@if(is_null($user->deleted_at) || $user->status == 1)
				<option value="1" selected="selected">Active</option>
				@else
				<option value="1">Active</option>
				@endif
				@if(!is_null($user->deleted_at) || $user->status == 0)
				<option value="0" selected="selected">Inactive</option>
				@else
				<option value="0">Inactive</option>
				@endif
			</select>
		</div>
	</div>
	<hr>
	<div class="form-group">
		<label for="role" class="col-sm-2 control-label">Assign Role</label>
		<div class="col-sm-6">
			<select name="role" id="role" class="form-control" required="required">
				<option value="">Change Role</option>
				@if ($user->role_id == 1)
				<option value="1" selected="selected">Student</option>
				@else
				<option value="1">Student</option>
				@endif
				@if ($user->role_id == 1)
				<option value="2" selected="selected">Admin</option>
				@else
				<option value="2">Admin</option>
				@endif
			</select>
		</div>
	</div>
	<hr>
	@if (!is_null($user->bookings))
	<?php $id = '';?>
	<h6>Status by equipment</h6>
	@foreach($user->bookings as $index => $booking)
	@if(!is_null(@$booking->equipment))
	<?php $id .= $booking->equipment->id.'##'; ?>
	<div class="form-group">
		<label for="equipment[]" class="col-sm-2 control-label"> {{ $booking->equipment->title }}</label>
		<div class="col-sm-6">
			<select name="equipment[]" id="equipment[]" class="form-control" required="required">
				<option value="">Status</option>
				@if ($booking->equipment->availability == 1)
				<option value="1" selected="selected">Active</option>
				@else
				<option value="1">Active</option>
				@endif
				@if ($booking->equipment->availability == 0)
				<option value="0" selected="selected">Inactive</option>
				@else
				<option value="0">Inactive</option>
				@endif
			</select>
		</div>
	</div>
	@endif
	@endforeach
	@endif
	<input type="hidden" name="equipment_id" id="equipment_id" class="form-control" value="{{ $id }}">
	<div class="form-group">
		<div class="col-sm-6">
			<a class="btn btn-link text-center" href="{{ url('/password/reset') }}" target="blank">
				Reset Password(send a link to reset password)
			</a>
		</div>
	</div>
</form>