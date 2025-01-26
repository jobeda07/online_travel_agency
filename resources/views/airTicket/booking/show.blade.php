@extends('admin.master')
@section('air_ticket', 'active submenu')
@section('air_collapse', 'show')
@section('booking','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-item-center">
                    <h4 class="card-title"> Hotel Booking Details</h4>
                    <a href="{{ route('airticket.booking.pdf.download', $airTicketBook->id) }}"
                        class="btn btn-primary btn-round ms-auto">
                        <i class="fas fa-print"></i>
                        PDF Download
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary  mt-4">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Booking Code</th>
                                        <th>Ticket Code</th>
                                        <th>Airline Code</th>
                                        <th>PNR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $airTicketBook->customer->first_name ?? '' }}
                                            {{ $airTicketBook->customer->last_name ?? '' }}
                                        </td>
                                        <td>{{ $airTicketBook->customer->phone ?? '' }}</td>
                                        <td>{{ $airTicketBook->booking_code ?? '' }}</td>
                                        <td>{{ $airTicketBook->ticket_code ?? '' }}</td>
                                        <td>{{ $airTicketBook->airline_code ?? '' }}</td>
                                        <td>{{ $airTicketBook->pnr ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary  mt-4">
                                <thead>
                                    <tr>
                                        <th>Travel Date</th>
                                        <th>Return Date</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Way Type</th>
                                        <th>No Of Adult</th>
                                        <th>No Of Child</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $airTicketBook->travel_date ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->return_date ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->country->name_en ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->city->name_en ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->way_type ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->no_of_adult ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->no_of_child ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary  mt-4">
                                <thead>
                                    <tr>
                                        <th>Adult Base Price</th>
                                        <th>City</th>
                                        <th>Total Price</th>
                                        <th>Discount Amount</th>
                                        <th>Point Discount</th>
                                        <th>vat</th>
                                        <th>Extra Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $airTicketBook->adult_base_price ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->child_base_price?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->total_price ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->discount_amount ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->point_discount ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->vat ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->extra_charge ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary mt-4">
                                <thead>
                                    <tr>
                                        <th>Grand Total</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $airTicketBook->grand_total ?? '' }}</td>
                                        <td>{{ $airTicketBook->paid_amount ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->grand_total-$airTicketBook->paid_amount }}</td>
                                        <td>{{ $airTicketBook->payment_method->display() ?? '' }}</td>
                                        <td>{{ $airTicketBook->payment_status ?? '' }}</td>
                                        <td>
                                            @if ($airTicketBook->status == 1)
                                                <a href="{{ route('hotel.booking.status', $airTicketBook->id) }}"
                                                    class="badge badge-success">active</a>
                                            @else
                                                <a href="{{ route('hotel.booking.status', $airTicketBook->id) }}"
                                                    class="badge badge-danger">Inactive</a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary mt-4">
                                <thead>
                                    <tr>
                                        <th>Charge Details</th>
                                        <th>Payment Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $airTicketBook->extra_charge_details ?? 'N/A' }}</td>
                                        <td>{{ $airTicketBook->payment_details ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
