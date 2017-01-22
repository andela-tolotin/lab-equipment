@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{{-- @include('admin.manage_user_account.logout') --}}
			<h5><a href="{{ route('my_profile') }}" class="pull-left"> << My page </a></h5><br>
			<hr>
			<h5>Book an equipment</h5>
			<table class="table table-responsive" id="book-equipment">
				<tbody>
					@if($equipment->count() > 0)
					<tr id="edit-eqipment{{ $equipment->id }}">
						<td><strong>{{ $equipment->title }}</strong></td>
						<td>{{ $equipment->model_no }}</td>
						<td>{{ $equipment->maker }}</td>
						<td><img src="{{ $equipment->equipment_photo }}" style="width: 50px; height: 50px;"></td>
						<td>
							<Strong>Status</Strong><br>
							<Strong>Max Time(per day)</Strong><br>
						</td>
						<td>
							{{ $equipment->availability == 1? 'Available': 'Unavailable'}}<br>
							{{ $equipment->max_reservation_time}}<br>
						</td>
					</tr>
					@endif
				</tbody>
			</table>
			<hr>
			<h5>Calendar</h5>
			<hr>
			{{-- <div class="container"> --}}
				<div class="row">
					<div class="col-md-5">
						<hr>
						<h5>Daytime(9am - 9pm)</h5>
						<h5>Maximum reservation time: 3hrs</h5>
						<hr>
						<h5>Night Time(9pm - 9am)</h5>
						<h5>Maximum reservation time: Unlimited</h5>
						<hr>
						<h5>Cancellation policy</h5>
						<h5>Before 1hr of reservation</h5>
						<hr>
					</div>
					<div class="col-md-7">
						<table class="table table-hover">
							<tbody>
								<tr>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			{{-- </div> --}}
		</div>
	</div>
</div>
@endsection