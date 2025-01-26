@extends('admin.master')
@section('common', 'active submenu')
@section('common_collapse', 'show')
@section('country','active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Country</div>
                </div>
                <div class="card-body">
                    @if (!isset($country))
                        <form action="{{ route('country.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name (En)</label>
                                        <input type="text" required name="name_en" value="{{ old('name_en') }}"
                                            class="form-control" id="" placeholder="Enter Name in English" />
                                        <small class="text-danger">
                                            @error('name_en')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name (Bn)</label>
                                        <input type="text" required name="name_bn" value="{{ old('name_bn') }}"
                                            class="form-control" id="" placeholder="Enter Name in Bangla" />
                                        <small class="text-danger">
                                            @error('name_bn')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Flag Image</label>
                                        <input type="file" required name="flag_img" value="{{ old('flag_img') }}"
                                            class="form-control" id="email" placeholder="Enter Email" />
                                        <small class="text-danger">
                                            @error('flag_img')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone Code</label>
                                        <input type="text" required name="phone_code" value="{{ old('phone_code') }}"
                                            class="form-control" id="" placeholder="Enter Phone" />
                                        <small class="text-danger">
                                            @error('phone_code')
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
                        <form action="{{ route('country.update', $country->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name (En)</label>
                                        <input type="text" required name="name_en" value="{{ $country->name_en }}"
                                            class="form-control" id="" placeholder="Enter First Name" />
                                        <small class="text-danger">
                                            @error('name_en')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name (Bn)</label>
                                        <input type="text" required name="name_bn" value="{{ $country->name_bn }}"
                                            class="form-control" id="" placeholder="Enter Last Name" />
                                        <small class="text-danger">
                                            @error('name_bn')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Flag Image</label>
                                        <input type="file" name="flag_img"
                                            class="form-control mb-3" id="email" placeholder="Enter Email" />
                                        @if($country->flag_img)
                                            <img src="{{ asset($country->flag_img) }}"  width="80" height="50" alt="no">
                                        @endif
                                        <small class="text-danger">
                                            @error('flag_img')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone Code</label>
                                        <input type="text" required name="phone_code" value="{{$country->phone_code}}"
                                            class="form-control" id="" placeholder="Enter Phone Code" />
                                        <small class="text-danger">
                                            @error('phone_code')
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
