@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-center">Request a User Training</h4>
                    <h6 class="text-center"> (First Wed. of each month/max. 5 persons)</h6>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal training_request" id="training_request" action="{{ route('create-training-request') }}" method="post">
                        <input type="hidden" name="_token" id="_token" class="form-control" value="{{ csrf_token() }}">
                        <p class="text-center">
                            <small><strong>Welcome to the Chemistry Department Equipment User System.</strong><br>  In order to use a Chemistry Department instruments, an user should first receive the <strong>user training</strong>.<br>  Every first Wed. of the month. Max 5 persons. <br>
                              Please <strong>sign up for the training session</strong> by filling out the form below.<br>
                            You can reserve and use the instrument only after the training session and approval of the instructor.</small>
                        </p>
                        <div class="form-group">
                            @if (session('message'))
                            <div class="alert alert-danger text-center">
                                {{ session('message') }}
                            </div>
                            @endif
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="model" class="col-sm-2 control-label">Student ID#</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Student ID" value="{{ old('student_id') }}" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="maker" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="required" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lab" class="col-sm-2 control-label">Lab</label>
                            <div class="col-sm-10">
                                <select id="lab" name="lab" class="form-control" required="required">
                                    <option value="">Choose Lab</option>
                                    @if ($labs->count() > 0)
                                    @foreach($labs as $lab)
                                    <option value="{{ $lab->id }}">{{ $lab->title }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipment" class="col-sm-2 control-label">Equipment</label>
                            <div class="col-sm-10">
                                <select id="equipment" name="equipment" class="form-control" required="required">
                                    <option value="">Choose equipment</option>
                                    @if ($equipments->count() > 0)
                                    @foreach($equipments as $equipment)
                                    <option value="{{ $equipment->id }}">{{ $equipment->title }} {{ $equipment->model_no }} </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="session" class="col-sm-2 control-label">Choose a Session</label>
                            <div class="col-sm-10">
                                <select id="session" name="session" class="form-control" required="required">
                                    <option value="0">Choose session</option>
                                    <?php
                                    $year = date('Y');
                                    $month = date('m');
                                    for ($m = 1; $m <= 12; $m++) {
                                        if ($m >= $month) {
                                            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                                            echo '<option value='.$year.'-'.$m.'-'.$m.'>'.$year.'.'.$month. '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-sm-2 control-label">Enter Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="new_password" name= "new_password" placeholder="Enter New Password" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="com_password" class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="com_password" name="com_password" placeholder="Confirm New Password" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-large btn-default request-training">Send</button>
                                <a class="btn btn-link open-modal" href="#" data-target="#contact-admin">
                                    Have a question?
                                </a>

                                <a class="btn btn-link " href="/">
                                    <strong>Back to Home</strong>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection