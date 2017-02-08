<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-center">Request a User Training</h4>
                    <h6 class="text-center"> (First Wed. of each month/max. 5 persons)</h6>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal training_request" id="training_request" action="<?php echo e(route('create-training-request')); ?>" method="post">
                        <input type="hidden" name="_token" id="_token" class="form-control" value="<?php echo e(csrf_token()); ?>">
                        <p class="text-center">
                            <small>Welcome to the Chemistry Department Equipment User System.  In order to use a Chemistry Department instruments, an user should first receive the user training . Every first Wed. of the month. Max 5 persons.   Please sign up for the training session by filling out the form below.
                            You can reserve and use the instrument only after the training session and approval of the instructor.</small>
                        </p>
                        <div class="form-group">
                            <?php if(session('message')): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo e(session('message')); ?>

                            </div>
                            <?php endif; ?>
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo e(old('name')); ?>" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="model" class="col-sm-2 control-label">Student ID#</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Model No" value="<?php echo e(old('student_id')); ?>" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="maker" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="required" value="<?php echo e(old('phone')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lab" class="col-sm-2 control-label">Lab</label>
                            <div class="col-sm-10">
                                <select id="lab" name="lab" class="form-control" required="required">
                                    <option value="">Choose Lab</option>
                                    <?php if($labs->count() > 0): ?>
                                    <?php $__currentLoopData = $labs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lab): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($lab->id); ?>"><?php echo e($lab->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipment" class="col-sm-2 control-label">Equipment</label>
                            <div class="col-sm-10">
                                <select id="equipment" name="equipment" class="form-control" required="required">
                                    <option value="">Choose equipment</option>
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
                                    $month = date('M');
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
                            <label for="new_password" class="col-sm-2 control-label">Enter New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="new_password" name= "new_password" placeholder="Enter New Password" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="com_password" class="col-sm-2 control-label">Confirm New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="com_password" name="com_password" placeholder="Confirm New Password" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-large btn-default request-training">Send</button>
                                <a class="btn btn-link" href="<?php echo e(url('/login')); ?>">
                                    Have a question?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>