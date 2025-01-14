@foreach($customers as $customer)
<tr>
    <td>{{$customer->full_name}}</td>
    <td>{{$customer->email}}</td>
    <td>{{$customer->location}}</td>
    <td>{{ \Carbon\Carbon::parse($customer->updated_at)->format('d-m-Y H:i:s') }}</td>
    <td>
        @if($customer->is_active == 1)
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-danger">Inactive</span>
        @endif
    </td>
    <td class="d-flex justify-content-center">
        <button class="btn btn-outline-primary edit-customer-btn" data-customer-id="{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Edit Customer">
            <i class="bx bx-edit"></i>
        </button>

        <button class="btn btn-danger remove-customer-btn" style="border-radius: 4px" data-customer-id="{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Remove Customer">
            <i class="bx bx-trash"></i>
        </button>

    </td>
</tr>
@endforeach
