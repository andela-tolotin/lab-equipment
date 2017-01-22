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
        </div>
    </div>
</div>
@endsection