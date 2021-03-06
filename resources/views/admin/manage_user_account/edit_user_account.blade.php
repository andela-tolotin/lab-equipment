<form class="form-horizontal" id="edit-user-account">
    <div class="form-group">
        <div class="col-sm-4">
            <select name="lab" id="lab" class="form-control" required="required">
                <option value="0">See by Lab</option>
                @if ($labs->count() > 0)
                @foreach($labs as $lab)
                <option value="{{ $lab->id }}">{{ $lab->title }}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="col-sm-4">
            <select name="status" id="status" class="form-control" required="required">
                <option value="">See by Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-responsive user-account-list">
                <tbody>
                    @if ($users->count() > 0)
                    @foreach($users as $index => $user)
                    <tr id="student-edit{{ $user->id}}" data-index="{{ $index + 1}}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $user->student_id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            @if ($user->status == 1)
                            {{ 'Active' }}
                            @else
                            {{ 'Inactive' }}
                            @endif
                        </td>
                        <td><a href="#"  class="student-edit" id="{{$user->id}}">Edit</a></td>
                        <td>
                        @if ($user->role_id == 1)
                        <a href="#"  class="student-delete" id="{{$user->id}}" rel= "{{ route('delete_user', ['id' => $user->id]) }}">Delete</a>
                        @else 
                        <span class="label label-default" >Disabled</span>
                        @endif 
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>
</form>
@include('admin.manage_user_account.edit_user_account_modal')