@extends('admin.master')
@section('common', 'active submenu')
@section('common_collapse', 'show')
@section('country','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Add Country</h4>
                    <a href="{{route('country.create')}}" class="btn btn-primary btn-round ms-auto">
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
                                <th>Flag</th>
                                <th>Name En</th>
                                <th>Name Bn</th>
                                <th>Phone Code</th>
                                <th>Status</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($countries) > 0)
                                    @foreach ($countries as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td><img src="{{ asset($item->flag_img) }}" width="60" height="40" alt="no"></td>
                                            <td>{{ $item->name_en }}</td>
                                            <td>{{ $item->name_bn }}</td>
                                            <td>{{ $item->phone_code }}</td>
                                            <td>
                                                @if($item->status ==1)
                                                  <a href="{{ route('country.status',$item->id) }}" class="badge badge-success">active</a>
                                                @else
                                                  <a href="{{ route('country.status',$item->id) }}" class="badge badge-danger">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('country.edit',$item->id) }}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('country.destroy', $item->id) }}" method="POST" style="display: inline;">
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
