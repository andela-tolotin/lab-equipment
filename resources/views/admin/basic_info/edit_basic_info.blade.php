<form class="form-horizontal">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="name" placeholder="Name" value="{{ Auth::user()->name }}">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" placeholder="Email" value="{{ Auth::user()->email }}" readonly="readonly">
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">Phone</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="phone" placeholder="Phone" value="{{ Auth::user()->phone }}">
        </div>
    </div>
    <div class="form-group">
        <label for="office" class="col-sm-2 control-label">Office</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="office" placeholder="Office">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label pull-left">Change password</label>
    </div>
    <div class="form-group">
        <label for="c_password" class="col-sm-2 control-label">Enter Current Password</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="c_password" placeholder="Enter Current Password">
        </div>
    </div>
    <div class="form-group">
        <label for="new_password" class="col-sm-2 control-label">Enter New Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="new_password" placeholder="Enter New Password">
        </div>
    </div>
    <div class="form-group">
        <label for="com_password" class="col-sm-2 control-label">Confirm New Password</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="com_password" placeholder="Confirm New Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-large btn-default">Save</button>
        </div>
    </div>
</form>