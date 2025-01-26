@extends('admin.master')
@section('accounts', 'active submenu')
@section('account_collapse', 'show')
@section('account_ledger','active')
@section('content')
    <div class="col-md-12">
        <form action="">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Account Ledger</h4>
                        <a href="{{ route('account.ledger.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-6 d-flex gap-3" style="margin-left: 10px">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Account Type</label>
                                    <select name="account_type" class="form-select form-control">
                                        <option value="">select one</option>
                                        <option value="1" @if ($account_type == 1) selected @endif>Deposit
                                        </option>
                                        <option value="2" @if ($account_type == 2) selected @endif>Credit
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="date" name="start_date" required class="form-control"
                                        value="{{ $start_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="date" name="end_date" required class="form-control"
                                        value="{{ $end_date }}">
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit"
                                    class="btn btn-secondary ms-auto datefilter d-flex align-items-center gap-2">
                                    <i class="fa fa-plus"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group d-flex align-items-center gap-2">
                                <label for="">search</label>
                                <input type="text" class="form-control searchData">
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Account Head</th>
                                    <th>Particular</th>
                                    <th>Create Date</th>
                                    <th>Deposit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($account_ledgers) > 0)
                                    @foreach ($account_ledgers as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->account_head->title ?? '' }}</td>
                                            <td>{{ $item->particulars ?? '' }}</td>
                                            <td>{{ $item->created_at->format('M j, Y') ?? '' }}</td>
                                            <td>{{ $item->debit ?? '' }}</td>
                                            <td>{{ $item->credit ?? '' }}</td>
                                            <td>{{ $item->balance ?? '' }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <form action="{{ route('account.ledger.destroy', $item->id) }}"
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
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Debit: {{ $total_debit }}</td>
                                            <td> Credit: {{ $total_credit }}</td>
                                            <td>Balance: {{ $total_balance }}</td>
                                        </tr>
                                    </tfoot>
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
        </form>
    </div>
@endsection
