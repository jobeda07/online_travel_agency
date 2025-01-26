@extends('admin.master')
@section('common', 'active submenu')
@section('common_collapse', 'show')
@section('currency','active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Currency</div>
                </div>
                <div class="card-body">
                    @if (!isset($currency))
                        <form action="{{ route('currency.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required name="name" value="{{ old('name') }}"
                                            class="form-control" id="" placeholder="Enter Name" />
                                        <small class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select Country</label>
                                        <select name="country_id" class="form-select form-control" id="defaultSelect">
                                            <option>select one</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @if (old('country_id') == $country->id) selected @endif>{{ $country->name_en }}</option>
                                            @endforeach
                                          </select>
                                          @error('name_bn')
                                                {{ $message }}
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 text-center">
                                <button class="btn btn-secondary">Submit</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('currency.update', $currency->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required name="name" value="{{ $currency->name }}"
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
                                        <label for="">Select Country</label>
                                        <select name="country_id" class="form-select form-control" id="defaultSelect">
                                            <option>select one</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @if ($currency->country_id == $country->id) selected @endif>{{ $country->name_en }}</option>
                                            @endforeach
                                          </select>
                                          @error('name_bn')
                                                {{ $message }}
                                            @enderror
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
