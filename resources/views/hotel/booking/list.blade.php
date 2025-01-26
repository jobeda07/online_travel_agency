@extends('admin.master')
@section('hotel_booking', 'active submenu')
@section('hotel_collapse', 'show')
@section('booking','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Add Airticket Booking</h4>
                    <a href="{{route('hotel.booking.create')}}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Create
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Hotel Code</th>
                                <th>Booking Code</th>
                                <th>CheckIn Date</th>
                                <th>CheckOut Date</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Status</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($hotelBooks) > 0)
                                    @foreach ($hotelBooks as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->customer->first_name ?? '' }} {{ $item->customer->last_name ?? '' }}</td>
                                            <td>{{ $item->customer->phone ?? '' }}</td>
                                            <td>{{ $item->hotel_code ?? '' }}</td>
                                            <td>{{ $item->booking_code ?? '' }}</td>
                                            <td>{{ $item->checkin_date ?? '' }}</td>
                                            <td>{{ $item->checkout_date ?? '' }}</td>
                                            <td>{{ $item->country->name_en ?? '' }}</td>
                                            <td>{{ $item->city->name_en ?? '' }}</td>
                                            <td>
                                                @if($item->status ==1)
                                                  <a href="{{ route('hotel.booking.status',$item->id) }}" class="badge badge-success">active</a>
                                                @else
                                                  <a href="{{ route('hotel.booking.status',$item->id) }}" class="badge badge-danger">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('hotel.booking.show',$item->id) }}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('hotel.booking.edit',$item->id) }}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('hotel.booking.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="deleteButton btn btn-link btn-danger" data-bs-toggle="tooltip" data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
