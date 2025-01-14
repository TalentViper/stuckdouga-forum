@foreach($users as $user)
<tr>
    <td>{{$user->first_name.' '.$user->last_name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->phone}}</td>
    <td>{{$user->address}}</td>
    <td>{{$user->city}}</td>
    <td>{{$user->postcode}}</td>
    <td>
        @if($user->status == 1)
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-danger">Inactive</span>
        @endif
    </td>


    <td class="d-flex justify-content-center">
        <div class="form-group">
            <select class="form-control user-action" data-user-id="{{$user->id}}" data-user-status="{{$user->status}}">
                <option value="0">Action</option>
                <option value="1">Edit Employee</option>
                <option value="2">{{ $user->status == 1 ? 'Make Inactive' : 'Make Active' }}</option>
                <option value="3">Delete Employee</option>
                <!-- <option value="3">Remove Invoice</option> -->
            </select>
        </div>
    </td>
</tr>
@endforeach
