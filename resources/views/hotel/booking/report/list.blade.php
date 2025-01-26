<table id="" class=" table table-striped table-hover">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Hotel Code</th>
            <th>Booking Code</th>
            <th>Room_ No</th>
            <th>CheckIn Date</th>
            <th>CheckOut Date</th>
            <th>Country</th>
            <th>City</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if (count($hotelBooks) > 0)
            @foreach ($hotelBooks as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->customer->first_name ?? '' }} {{ $item->customer->last_name ?? '' }}</td>
                    <td>{{ $item->customer->phone ?? '' }}</td>
                    <td>{{ $item->hotel_code ?? '' }}</td>
                    <td>{{ $item->booking_code ?? '' }}</td>
                    <td>{{ $item->room_no ?? '' }}</td>
                    <td>{{ $item->checkin_date ?? '' }}</td>
                    <td>{{ $item->checkout_date ?? '' }}</td>
                    <td>{{ $item->country->name_en ?? '' }}</td>
                    <td>{{ $item->city->name_en ?? '' }}</td>
                    <td>
                        @if ($item->status == 1)
                            <a class="badge badge-success">active</a>
                        @else
                            <a class="badge badge-danger">Inactive</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">No item found!</td>
            </tr>
        @endif
    </tbody>
</table>
<div class="pagination">
    {{ $hotelBooks->links() }}
</div>
