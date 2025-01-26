<table id="" class=" table table-striped table-hover">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Booking Code</th>
            <th>Ticket Code</th>
            <th>Airline Code</th>
            <th>Travel Date</th>
            <th>Return Date</th>
            <th>Country</th>
            <th>City</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if (count($airTicketBooks) > 0)
            @foreach ($airTicketBooks as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->customer->first_name ?? '' }}
                        {{ $item->customer->last_name ?? '' }}</td>
                    <td>{{ $item->customer->phone ?? '' }}</td>
                    <td>{{ $item->booking_code ?? '' }}</td>
                    <td>{{ $item->ticket_code ?? '' }}</td>
                    <td>{{ $item->airline_code ?? '' }}</td>
                    <td>{{ $item->travel_date ?? '' }}</td>
                    <td>{{ $item->return_date ?? '' }}</td>
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
    {{ $airTicketBooks->links() }}
</div>
