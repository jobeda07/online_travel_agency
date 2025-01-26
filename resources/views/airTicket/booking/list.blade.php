@extends('admin.master')
@section('air_ticket', 'active submenu')
@section('air_collapse', 'show')
@section('booking','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Add Airticket Booking</h4>
                    <a href="{{route('airticket.booking.create')}}" class="btn btn-primary btn-round ms-auto">
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
                                <th>Travel Date</th>
                                <th>Return Date</th>
                                <th>Country</th>
                                <th>City</th>
                                {{-- <th>Price</th>
                                <th>Vat</th>
                                <th>Extra Charge</th>
                                <th>Charge Details</th>
                                <th>Paid Amount</th>
                                <th>Payment Status</th> --}}
                                <th>Status</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($airTicketBooks) > 0)
                                    @foreach ($airTicketBooks as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->customer->first_name ?? '' }} {{ $item->customer->last_name ?? '' }}</td>
                                            <td>{{ $item->customer->phone ?? '' }}</td>
                                            <td>{{ $item->travel_date ?? '' }}</td>
                                            <td>{{ $item->return_date ?? '' }}</td>
                                            <td>{{ $item->country->name_en ?? '' }}</td>
                                            <td>{{ $item->city->name_en ?? '' }}</td>
                                            {{-- <td>{{ $item->price ?? '' }}</td>
                                            <td>{{ $item->vat ?? '' }}</td>
                                            <td>{{ $item->extra_charge ?? '' }}</td>
                                            <td>{{ $item->extra_charge_details ?? '' }}</td>
                                            <td>{{ $item->paid_amount ?? '' }}</td>
                                            <td>{{ $item->payment_status ?? '' }}</td> --}}
                                            <td>
                                                @if($item->status ==1)
                                                  <a href="{{ route('airticket.booking.status',$item->id) }}" class="badge badge-success">active</a>
                                                @else
                                                  <a href="{{ route('airticket.booking.status',$item->id) }}" class="badge badge-danger">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('airticket.booking.show',$item->id) }}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('airticket.booking.edit',$item->id) }}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('airticket.booking.destroy', $item->id) }}" method="POST" style="display: inline;">
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
