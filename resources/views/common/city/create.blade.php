@extends('admin.master')
@section('common', 'active submenu')
@section('common_collapse', 'show')
@section('city','active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">City</div>
                </div>
                <div class="card-body">
                    @if (!isset($city))
                        <form action="{{ route('city.store') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description (En)</label>
                                        <textarea name="description_en" class="form-control" id="comment" rows="5">{{ old('description_en') }}
                                        </textarea>
                                        <small class="text-danger">
                                            @error('description_en')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description (Bn)</label>
                                        <textarea name="description_bn" class="form-control" id="comment" rows="5">{{ old('description_bn') }}
                                        </textarea>
                                        <small class="text-danger">
                                            @error('description_bn')
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
                        <form action="{{ route('city.update', $city->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name (En)</label>
                                        <input type="text" required name="name_en" value="{{ $city->name_en }}"
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
                                        <input type="text" required name="name_bn" value="{{ $city->name_bn }}"
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
                                        <label for="">Select Country</label>
                                        <select name="country_id" class="form-select form-control" id="defaultSelect">
                                            <option>select one</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @if ($city->country_id == $country->id) selected @endif>{{ $country->name_en }}</option>
                                            @endforeach
                                          </select>
                                          @error('name_bn')
                                                {{ $message }}
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description (En)</label>
                                        <textarea name="description_en" class="form-control" id="comment" rows="5">{{$city->description_en}}
                                        </textarea>
                                        <small class="text-danger">
                                            @error('description_en')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description (Bn)</label>
                                        <textarea name="description_bn" class="form-control" id="comment" rows="5">{{$city->description_bn}}
                                        </textarea>
                                        <small class="text-danger">
                                            @error('description_bn')
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
