@extends('admin.master')
@section('common', 'active submenu')
@section('common_collapse', 'show')
@section('payment_method','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">payment Method</h4>
                    <a href="{{route('paymentMethod.create')}}" class="btn btn-primary btn-round ms-auto">
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($payment_methods) > 0)
                                    @foreach ($payment_methods as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td><img src="{{ asset($item->image) }}" width="60" height="40" alt="no"></td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if($item->status ==1)
                                                  <a href="{{ route('paymentMethod.status',$item->id) }}" class="badge badge-success">active</a>
                                                @else
                                                  <a href="{{ route('paymentMethod.status',$item->id) }}" class="badge badge-danger">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('paymentMethod.edit',$item->id) }}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('paymentMethod.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                                        <td colspan="5">No item found!</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
