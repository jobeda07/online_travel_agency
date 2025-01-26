@extends('admin.master')
@section('common', 'active submenu')
@section('common_collapse', 'show')
@section('payment_method','active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Payment Method</div>
                </div>
                <div class="card-body">
                    @if (!isset($paymentMethod))
                        <form action="{{ route('paymentMethod.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required name="name" value="{{ old('name') }}"
                                            class="form-control" id="" placeholder="Enter Name in English" />
                                        <small class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" required name="image" value="{{ old('image') }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 text-center">
                                <button class="btn btn-secondary">Submit</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('paymentMethod.update', $paymentMethod->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required name="name" value="{{ $paymentMethod->name }}"
                                            class="form-control" id="" placeholder="Enter  Name" />
                                        <small class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" name="image"
                                            class="form-control mb-3" id="email" placeholder="Enter Email" />
                                        @if($paymentMethod->image)
                                            <img src="{{ asset($paymentMethod->image) }}"  width="80" height="50" alt="no">
                                        @endif
                                        <small class="text-danger">
                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class=" p-2">
                                <button class="btn btn-secondary">Update</button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
