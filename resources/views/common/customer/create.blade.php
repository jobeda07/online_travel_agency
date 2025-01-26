@extends('admin.master')
@section('customer', 'active submenu')
@section('customer_collapse', 'show')
@section('list','active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Customer</div>
                </div>
                <div class="card-body">
                    @if (!isset($customer))
                        <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" required name="first_name" value="{{ old('first_name') }}"
                                            class="form-control" id="" placeholder="Enter First Name" />
                                        <small class="text-danger">
                                            @error('first_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <input type="text" required name="last_name" value="{{ old('last_name') }}"
                                            class="form-control" id="" placeholder="Enter Last Name" />
                                        <small class="text-danger">
                                            @error('last_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" required name="email" value="{{ old('email') }}"
                                            class="form-control" id="email" placeholder="Enter Email" />
                                        <small class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" required name="phone" value="{{ old('phone') }}"
                                            class="form-control" id="phone" placeholder="Enter Phone" />
                                        <small class="text-danger">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">UserName</label>
                                        <input type="text" required name="username" value="{{ old('username') }}"
                                            class="form-control" id="" placeholder="Enter user name" />
                                        <small class="text-danger">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" required name="password" class="form-control" id="password"
                                            placeholder="Password" />
                                        <small class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <textarea name="address" class="form-control" id="comment" rows="5">{{ old('address') }}
                                    </textarea>
                                        <small class="text-danger">
                                            @error('address')
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
                    @else
                        <form action="{{ route('customer.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" required name="first_name" value="{{$customer->first_name}}"
                                            class="form-control" id="" placeholder="Enter First Name" />
                                        <small class="text-danger">
                                            @error('first_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <input type="text" required name="last_name" value="{{$customer->last_name}}"
                                            class="form-control" id="" placeholder="Enter Last Name" />
                                        <small class="text-danger">
                                            @error('last_name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" required name="email" value="{{$customer->email}}"
                                            class="form-control" id="email" placeholder="Enter Email" />
                                        <small class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" required name="phone" value="{{$customer->phone}}"
                                            class="form-control" id="phone" placeholder="Enter Phone" />
                                        <small class="text-danger">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">UserName</label>
                                        <input type="text" required name="username" value="{{$customer->username}}"
                                            class="form-control" id="" placeholder="Enter user name" />
                                        <small class="text-danger">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Password" />
                                        <small class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <textarea name="address" required class="form-control" id="comment" rows="5">{{ $customer->address }}
                                    </textarea>
                                        <small class="text-danger">
                                            @error('address')
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
