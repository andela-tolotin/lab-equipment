@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h4>My Page</h4>
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td>
                            <strong>{{ Auth::user()->name }}</strong><br>
                            <strong>{{ Auth::user()->student_id ?? Auth::user()->student_id ?? 'NIL' }}</strong><br>
                        </td>
                        <td>
                            {{ Auth::user()->email }} <br>
                            {{ Auth::user()->phone ?? Auth::user()->phone ?? 'NIL' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>
                <h5><strong>Upcoming Booking</strong> <span class="text-danger pull-right">Cancellation is allowed until 1hr. before your reservation</span></h5>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><strong>NMR</strong></td>
                            <td>400-MR D22</td>
                            <td>{{ date('Y/m/d') }}</td>
                            <td>11:00 - 11:10</td>
                            <td><button type="button" class="btn btn-default pull-right">Cancel</button></td>
                        </tr>
                    </tbody>
                </table>
            </p>

            <p>
                <h5><strong>Booking History</strong></h5>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><strong>NMR</strong></td>
                            <td>400-MR D22</td>
                            <td>{{ date('Y/m/d') }}</td>
                            <td>11:00 - 11:10</td>
                            <td>Completed</td>
                        </tr>
                    </tbody>
                </table>
            </p>
        </div>
    </div>
</div>
@endsection