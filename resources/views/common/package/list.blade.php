@extends('admin.master')
@section('package', 'active submenu')
@section('package_collapse', 'show')
@section('list','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Holiday Package</h4>
                    <a href="{{route('holiday.package.create')}}" class="btn btn-primary btn-round ms-auto">
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
                                <th>Title</th>
                                <th>Price</th>
                                <th>Validaty Start</th>
                                <th>Validaty End</th>
                                <th>Country</th>
                                <th>status</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($holidayPackages) > 0)
                                    @foreach ($holidayPackages as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->validaty_start }}</td>
                                            <td>{{ $item->validaty_end }}</td>
                                            <td>{{ $item->country->name_en }}</td>
                                            <td>
                                                @if($item->status ==1)
                                                    <a href="{{ route('holiday.package.status',$item->id) }}" class="badge badge-success">active</a>
                                                @else
                                                    <a href="{{ route('holiday.package.status',$item->id) }}" class="badge badge-danger">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('holiday.package.show',$item->id) }}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Show Task">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('holiday.package.edit',$item->id) }}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('customer.destroy',$customer->id) }}"  data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-danger" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </a> --}}
                                                    <form action="{{ route('holiday.package.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                                        <td colspan="8">No customer found!</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
