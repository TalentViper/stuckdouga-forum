@foreach($bookings as $booking)
@if($booking->status == 'pending')
<tr>
    <td>{{$booking->booking_id}}</td>
    <td>{{ date('d-m-Y', strtotime($booking->start_date)) }} | {{ $booking->start_time }}</td>
    @if($booking->user_id != null)
    <td>{{ $booking->customer->first_name.' '.$booking->customer->last_name}}</td>
    @else
    <td></td>
    @endif
    <td>{{ $booking->address }}</td>
    <td>{{ strtoupper($booking->garden->parking) }}</td>
    <td>
        <span class="badge badge-primary">{{ strtoupper($booking->status) }}</span>
    </td>
    <td>
        <div class="form-group">
            <select class="form-control booking-action" data-booking-id="{{$booking->id}}">
                <option value="0">Action</option>
                <option value="1">View Details</option>
                <option value="2">Edit Booking</option>
            </select>
        </div>
    </td>
</tr>
@endif
@endforeach
