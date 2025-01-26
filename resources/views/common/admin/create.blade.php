@extends('admin.master')
@section('access_control', 'active submenu')
@section('access_collapse', 'show')
@section('user_list','active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">User</div>
                </div>
                <div class="card-body">
                    @if (!isset($admin))
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select Role</label>
                                        <select name="role" class="form-select form-control" id="defaultSelect">
                                            <option>select one</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" @if (old('role') == $role->name) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                          </select>
                                          @error('name_bn')
                                                {{ $message }}
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required name="name" value="{{ old('name') }}"
                                            class="form-control" id="" placeholder="Enter First Name" />
                                        <small class="text-danger">
                                            @error('name')
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
                        <form action="{{ route('user.update',$admin->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select Role</label>
                                        <select name="role" class="form-select form-control" id="defaultSelect">
                                            <option>select one</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" @if ($role->name == $admin->getRoleNames()->first()) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                          </select>
                                          @error('name_bn')
                                              {{ $message }}
                                          @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required name="name" value="{{$admin->name}}"
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
                                        <label for="email">Email</label>
                                        <input type="email" required name="email" value="{{$admin->email}}"
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
                                        <input type="text" required name="phone" value="{{$admin->phone}}"
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
                                        <input type="text" required name="username" value="{{$admin->username}}"
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
                                        <textarea name="address" required class="form-control" id="comment" rows="5">{{ $admin->address }}
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
