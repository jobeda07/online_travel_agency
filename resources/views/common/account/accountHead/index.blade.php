@extends('admin.master')
@section('accounts', 'active submenu')
@section('account_collapse', 'show')
@section('account_head','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Account Head List</h4>
                    <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fa fa-plus"></i>Add
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th> Title</th>
                                <th> Status</th>
                                <th style="width:30%;text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($account_heads) > 0)
                                @foreach ($account_heads as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->title ?? '' }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <a href="{{ route('account.head.status', $item->id) }}"
                                                    class="badge badge-success">active</a>
                                            @else
                                                <a href="{{ route('account.head.status', $item->id) }}"
                                                    class="badge badge-danger">Inactive</a>
                                            @endif
                                        </td>
                                        <td class="">
                                            <div class="">
                                                <a data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                                                    data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update Account Head
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('account.head.update', $item->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Title</label>
                                                                                <input type="text" required
                                                                                    name="title"
                                                                                    value="{{ $item->title }}"
                                                                                    class="form-control" id=""
                                                                                    placeholder="Enter Title" />
                                                                                <small class="text-danger">
                                                                                    @error('title')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm pl-5">Update</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('account.head.destroy', $item->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="deleteButton btn btn-link btn-danger"
                                                        data-bs-toggle="tooltip" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No customer found!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Account Head</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('account.head.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" required name="title" value="{{ old('title') }}"
                                        class="form-control" id="" placeholder="Enter Title" />
                                    <small class="text-danger">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm pl-5">Save</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
