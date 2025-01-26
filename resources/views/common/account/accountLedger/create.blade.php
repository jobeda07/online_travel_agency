@extends('admin.master')
@section('accounts', 'active submenu')
@section('account_collapse', 'show')
@section('account_ledger','active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Account Ledger Add </div>
                </div>
                <div class="card-body">
                        <form action="{{ route('account.ledger.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select Account Head</label>
                                        <select name="account_head_id" class="form-select form-control" required>
                                            <option value="">select one</option>
                                            @foreach ($account_heads as $head)
                                                <option value="{{ $head->id }}" @if (old('account_head_id') == $head->id) selected @endif>{{ $head->title }}</option>
                                            @endforeach
                                          </select>
                                          @error('account_head_id')
                                                {{ $message }}
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Account Type</label>
                                        <select name="account_type" class="form-select form-control" required>
                                            <option value="">select one</option>
                                                <option value="1" @if (old('account_type') == 1) selected @endif>Deposit</option>
                                                <option value="2" @if (old('account_type') == 2) selected @endif>Credit</option>
                                          </select>
                                          @error('account_type')
                                                {{ $message }}
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" min="1" required name="amount" value="{{ old('amount') }}"
                                            class="form-control"  placeholder="Enter Amount" />
                                        <small class="text-danger">
                                            @error('amount')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Particulars</label>
                                        <input type="text" required name="particulars" value="{{ old('particulars') }}"
                                            class="form-control" id="" placeholder="Enter particulars" />
                                        <small class="text-danger">
                                            @error('particulars')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class=" p-2">
                                <button class="btn btn-secondary">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
