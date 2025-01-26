@extends('admin.master')
@section('hotel_booking', 'active submenu')
@section('hotel_collapse', 'show')
@section('booking','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-item-center">
                    <h4 class="card-title"> Hotel Booking Details</h4>
                    <a href="{{ route('hotel.booking.pdf.download', $hotelBook->id) }}"
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
                                        <th>Hotel Code</th>
                                        <th>Booking Code</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $hotelBook->customer->first_name ?? '' }}
                                            {{ $hotelBook->customer->last_name ?? '' }}
                                        </td>
                                        <td>{{ $hotelBook->customer->phone ?? '' }}</td>
                                        <td>{{ $hotelBook->hotel_code ?? '' }}</td>
                                        <td>{{ $hotelBook->booking_code ?? '' }}</td>
                                        <td>{{ $hotelBook->checkin_date ?? '' }}</td>
                                        <td>{{ $hotelBook->checkout_date ?? '' }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary  mt-4">
                                <thead>
                                    <tr>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Room No</th>
                                        <th>Room Type</th>
                                        <th>No Of Adult</th>
                                        <th>No Of Child</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $hotelBook->country->name_en ?? '' }}</td>
                                        <td>{{ $hotelBook->city->name_en ?? '' }}</td>
                                        <td>{{ $hotelBook->room_no ?? '' }}</td>
                                        <td>{{ $hotelBook->room_type->display() ?? '' }}</td>
                                        <td>{{ $hotelBook->no_of_adult ?? '' }}</td>
                                        <td>{{ $hotelBook->no_of_child ?? '' }}</td>
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
                                        <td>{{ $hotelBook->adult_base_price ?? '' }}</td>
                                        <td>{{ $hotelBook->child_base_price?? '' }}</td>
                                        <td>{{ $hotelBook->total_price ?? '' }}</td>
                                        <td>{{ $hotelBook->discount_amount ?? '' }}</td>
                                        <td>{{ $hotelBook->point_discount ?? '' }}</td>
                                        <td>{{ $hotelBook->vat ?? '' }}</td>
                                        <td>{{ $hotelBook->extra_charge ?? '' }}</td>
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
                                        <td>{{ $hotelBook->grand_total ?? '' }}</td>
                                        <td>{{ $hotelBook->paid_amount ?? '' }}</td>
                                        <td>{{ $hotelBook->grand_total-$hotelBook->paid_amount }}</td>
                                        <td>{{ $hotelBook->payment_method->display() ?? '' }}</td>
                                        <td>{{ $hotelBook->payment_status ?? '' }}</td>
                                        <td>
                                            @if ($hotelBook->status == 1)
                                                <a href="{{ route('hotel.booking.status', $hotelBook->id) }}"
                                                    class="badge badge-success">active</a>
                                            @else
                                                <a href="{{ route('hotel.booking.status', $hotelBook->id) }}"
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
                                        <td>{{ $hotelBook->extra_charge_details ?? '' }}</td>
                                        <td>{{ $hotelBook->payment_details ?? '' }}</td>
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
