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
						<td>{{ $equipment->title }}</td>
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
		</div>
	</div>
</div>
@endsection