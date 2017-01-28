@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<input type="hidden" name="_token" id="_token" class="form-control" value="{{ csrf_token() }}">
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
					<div class="col-md-4">
						<div class="form-group">
							<div class='input-group date' id='datetimepicker1'>
								<input type='text' class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<hr>
						<h5>Daytime (9am - 9pm)</h5>
						<h5>Maximum reservation time: 3hrs</h5>
						<hr>
						<h5>Night Time (9pm - 9am)</h5>
						<h5>Maximum reservation time: Unlimited</h5>
						<hr>
						<h5>Cancellation policy</h5>
						<h5>Before 1hr of reservation</h5>
						<hr>
					</div>
					<div class="col-md-8">
						<h5>You select <span id="time"></span></h5>
						<table class="table table-hover">
							<tbody>
								<?php $count = 0; ?>
								<?php for ($i = 9; $i <= 33; $i++): ?>
								<tr>
									@if ($i <= 24)
									<td>{{ $i.":00" }}</td>
									@else
									<td>{{ (int)($i - 24).":00" }}</td>
									@endif
									<td>
										<div class="checkbox">
											<label>
												@if ($i <= 24)
												<input type="checkbox" value="{{ $i }}:00 - {{ $i }}:10">
												:00 - 10
												@else
												<input type="checkbox" value="{{ ($i - 24) }}:00 - {{ ($i - 24) }}:10">
												:00 - 10
												@endif
											</label>
										</div>
									</td>
									<td><div class="checkbox">
										<label>
											@if ($i <= 24)
											<input type="checkbox" value="{{ $i }}:10 - {{ $i }}:20">
											:10 - 20
											@else
											<input type="checkbox" value="{{ ($i - 24) }}:10 - {{ ($i - 24) }}:20">
											:10 - 20
											@endif
										</label>
									</div></td>
									<td><div class="checkbox">
										<label>
											@if ($i <= 24)
											<input type="checkbox" value="{{ $i }}:20 - {{ $i }}:30">
											:20 - 30
											@else
											<input type="checkbox" value="{{ ($i - 24) }}:20 - {{ ($i - 24) }}:30">
											:20 - 30
											@endif
										</label>
									</div></td>
									<td><div class="checkbox">
										<label>
											@if ($i <= 24)
											<input type="checkbox" value="{{ $i }}:30 - {{ $i }}:40">
											:30 - 40
											@else
											<input type="checkbox" value="{{ ($i - 24) }}:30 - {{ ($i - 24) }}:40">
											:30 - 40
											@endif
										</label>
									</div></td>
									<td><div class="checkbox">
										<label>
											@if ($i <= 24)
											<input type="checkbox" value="{{ $i }}:40 - {{ $i }}:40">
											:40 - 50
											@else
											<input type="checkbox" value="{{ ($i - 24) }}:40 - {{ ($i - 24) }}:40">
											:40 - 50
											@endif
										</label>
									</div></td>
									<td><div class="checkbox">
										<label>
											@if ($i <= 24)
											<input type="checkbox" value="{{ $i }}:50 - {{ $i }}:00">
											:50 - 00
											@else
											<input type="checkbox" value="{{ ($i - 24) }}:50 - {{ ($i - 24) }}:00">
											:50 - 00
											@endif
										</label>
									</div></td>
								</tr>
								<?php endfor ?>
							</tbody>
						</table>
						<button type="button" class="btn btn-default book-now" data-id="{{ $equipment->id }}" id="book-now">Book Now</button>
					</div>
				</div>
			{{-- </div> --}}
			<script>
				$(function() {
					var checkbox = $('div.checkbox input[type="checkbox"]');
					checkbox.each(function(index, el) {
						var _this = $(this);
						@if(count($equipment) > 0 && !is_null(@$equipment->bookings))
						@foreach($equipment->bookings as $booking)
					    @if (count($booking->time_slot) > 0)
					    @foreach($booking->time_slot as $slot)
					      var slot = "{{ $slot }}"
					      if (slot === _this.val()) {
					      	_this.attr({'checked': true, 'disabled': true});
					      	_this.parent().css('text-decoration', 'line-through')
					      }
					    @endforeach
					  @endif
					@endforeach
					@endif
					});
				});
			</script>
			<style type="text/css">
				.radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
					position: inherit;
				}
				table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
					vertical-align: middle; 
				}
			</style>
		</div>
	</div>
</div>
@include('student.booking_detail_modal')
@endsection