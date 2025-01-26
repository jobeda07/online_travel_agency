@extends('admin.master')
@section('support_ticket', 'active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Support Ticket</h4>
                    {{-- <a href="{{route('city.create')}}" class="btn btn-primary btn-round ms-auto">
                    <i class="fa fa-plus"></i>
                    Create
                </a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Support Token</th>
                                <th>Send By</th>
                                <th>Assign TO</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($support_tickets) > 0)
                                @foreach ($support_tickets as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->token }}</td>
                                        <td>{{ $item->customer->first_name ?? 'N/A' }}</td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" class="btn btn-link btn-primary btn-lg"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $item->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Token No:
                                                                    {{ $item->token }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                    action="{{ route('adminSupportTicket.update', $item->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row p-2">
                                                                        <div class="form-group">
                                                                            <label for="">Assign To</label>
                                                                            <select name="assigned_to"
                                                                                class="form-select form-control"
                                                                                id="defaultSelect">
                                                                                <option>select one</option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id }}"
                                                                                        @if ($item->assigned_to == $user->id) selected @endif>
                                                                                        {{ $user->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('name_bn')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 text-center">
                                                                        <button type="submit"
                                                                            class="btn btn-secondary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ route('adminSupportTicket.show', $item->id) }}"
                                                    data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <form action="{{ route('adminSupportTicket.destroy', $item->id) }}"
                                                    method="POST" style="display: inline;">
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
                                    <td colspan="8">No item found!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
