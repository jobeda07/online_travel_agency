@extends('admin.master')
@section('setting', 'active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Setting</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="card-body">
                         <h4 style="text-align:center">Settings Option</h4>
                        @if(!isset($setting))
                            <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 p-4">
                                        <div class="card p-4">
                                            <h4 class="pb-2 text-center" style="font-weight: bold;">Application Settings</h4>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Site Name: <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="site_name">
                                                        <input type="text" name="site_name" value="{{ old('site_name') }}" required class="form-control " id="">
                                                        <span class="text-danger">@error('site_name'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Email<small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="email">
                                                        <input type="email" name="email" value="{{ old('email') }}" required class="form-control " id="">
                                                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email">Phone<small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="phone">
                                                        <input type="text" name="phone" value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^0-9\s\+\-\(\)]/g, '')" required  class="form-control " id="">
                                                        <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email">Open & Close Hour<small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="open_close_time">
                                                        <input type="text" name="open_close_time" value="{{ old('open_close_time') }}"  class="form-control " id="" required>
                                                        <span class="text-danger">@error('open_close_time'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email">Whats up</label>
                                                        <input type="hidden" name="type[]" id="" value="whats_up">
                                                        <input type="text" name="whats_up"  oninput="this.value = this.value.replace(/[^0-9\s\+\-\(\)]/g, '')" value="{{ old('whats_up')}}"  class="form-control " id="">
                                                        <span class="text-danger">@error('whats_up'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email">Address<small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="address">
                                                        <input type="text" name="address" value="{{ old('address') }}"  required class="form-control " id="">
                                                        <span class="text-danger">@error('address'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 p-4">
                                        <div class="card p-4">
                                            <h4 class="pb-2 text-center" style="font-weight: bold;">Social Link Settings</h4>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Facebook:</label>
                                                        <input type="hidden" name="type[]" id="" value="facebook_link">
                                                        <input type="text" name="facebook_link" value="{{ old('facebook_link') }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('facebook_link'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">You Tube:</label>
                                                        <input type="hidden" name="type[]" id="" value="youtube_link">
                                                        <input type="text" name="youtube_link" value="{{ old('youtube_link') }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('youtube_link'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">LinkedIn:</label>
                                                        <input type="hidden" name="type[]" id="" value="linkedin">
                                                        <input type="text" name="linkedin" value="{{ old('linkedin') }}" class="form-control " id="">
                                                        <span class="text-danger">@error('linkedin'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Pintarest:</label>
                                                        <input type="hidden" name="type[]" id="" value="pintarest">
                                                        <input type="text" name="pintarest" value="{{ old('pintarest') }}" class="form-control " id="">
                                                        <span class="text-danger">@error('pintarest'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Instagram: <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="instagram">
                                                        <input type="text" name="instagram" value="{{ old('instagram') }}" class="form-control " id="">
                                                        <span class="text-danger">@error('instagram'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-4 ">
                                        <div class="card p-4">
                                            <h4 class="pb-2 text-center" style="font-weight: bold;">Logo Settings</h4>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Header Logo<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="hidden" name="type[]" id="" value="header_logo">
                                                                <input type="file" name="header_logo"
                                                                    class="form-control" id="imageInput">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <img src="{{ asset('backend/images/no-image.png') }}" width="180px" height="100px" id="" class="custom-img" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Footer Logo<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="hidden" name="type[]" id="" value="footer_logo">
                                                                <input type="file" name="footer_logo"
                                                                    class="form-control" id="imageInput2">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="form-group">
                                                            <img src="{{ asset('backend/images/no-image.png') }}" width="180px" height="100px" id="" class="custom-img" alt="">
                                                        </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Fav Icon<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="hidden" name="type[]" id="" value="fav_icon">

                                                                <input type="file" name="fav_icon"
                                                                    class="form-control" id="imageInput3">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="form-group">
                                                            <img src="{{ asset('backend/images/no-image.png') }}" width="180px" height="100px" id="" class="custom-img" alt="">
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-4 ">
                                        <div class="card p-4">
                                            <h4 class="pb-2 text-center" style="font-weight: bold;">Customer Discount Point Settings</h4>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Purchase Amount: <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="purchase_amount">
                                                        <input type="number" min="1" name="purchase_amount" value="{{ old('purchase_amount') }}" class="form-control " id="">
                                                        <span class="text-danger">@error('purchase_amount'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Purchase Point: <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="purchase_amount_point">
                                                        <input type="number" min="1" name="purchase_amount_point" value="{{ old('purchase_amount_point') }}" class="form-control " id="">
                                                        <span class="text-danger">@error('purchase_amount_point'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Point Discount : <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="point_amount_discount">
                                                        <input type="number" min="1" name="point_amount_discount" value="{{ old('point_amount_discount') }}" class="form-control " id="">
                                                        <span class="text-danger">@error('point_amount_discount'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">submit</button>
                            </form>
                        @else
                            <form action="{{ route('setting.update',$setting->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-6 p-4">
                                        <div class="card p-4">
                                                <h4 class="pb-2 text-center" style="font-weight: bold;">Application Settings</h4>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Site Name edit: <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="site_name">
                                                        <input type="text" name="site_name" value="{{ get_setting('site_name')->value ?? '' }}" required class="form-control " id="">
                                                        <span class="text-danger">@error('site_name'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="username">Email<small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="email">
                                                        <input type="email" name="email" value="{{ get_setting('email')->value ?? '' }}" required class="form-control " id="">
                                                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email">Phone<small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="phone">
                                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9\s\+\-\(\)]/g, '')" name="phone" value="{{ get_setting('phone')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email">Open & Close Hour<small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="open_close_time">
                                                        <input type="text" name="open_close_time" value="{{ get_setting('open_close_time')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('open_close_time'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email">Whats up</label>
                                                        <input type="hidden" name="type[]" id="" value="whats_up">
                                                        <input type="text" name="whats_up"  oninput="this.value = this.value.replace(/[^0-9\s\+\-\(\)]/g, '')" value="{{ get_setting('whats_up')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('whats_up'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email">Address<small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="address">
                                                        <input type="text" name="address" value="{{ get_setting('address')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('address'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 p-4">
                                        <div class="card p-4">
                                            <h4 class="pb-2 text-center" style="font-weight: bold;">Social Link Settings</h4>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Facebook:</label>
                                                        <input type="hidden" name="type[]" id="" value="facebook_link">
                                                        <input type="text" name="facebook_link" value="{{ get_setting('facebook_link')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('facebook_link'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">You Tube:</label>
                                                        <input type="hidden" name="type[]" id="" value="youtube_link">
                                                        <input type="text" name="youtube_link" value="{{ get_setting('youtube_link')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('youtube_link'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">LinkedIn:</label>
                                                        <input type="hidden" name="type[]" id="" value="linkedin">
                                                        <input type="text" name="linkedin" value="{{ get_setting('linkedin')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('linkedin'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Pintarest:</label>
                                                        <input type="hidden" name="type[]" id="" value="pintarest">
                                                        <input type="text" name="pintarest" value="{{ get_setting('pintarest')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('pintarest'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Instagram: <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="instagram">
                                                        <input type="text" name="instagram" value="{{ get_setting('instagram')->value ?? '' }}"  class="form-control " id="">
                                                        <span class="text-danger">@error('instagram'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-4 ">
                                        <div class="card p-4">
                                            <h4 class="pb-2 text-center" style="font-weight: bold;">Logo Settings</h4>
                                            <div class="row pb-5">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Header Logo<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="hidden" name="type[]" id="" value="header_logo">
                                                                <input type="file" name="header_logo" header_logo
                                                                    class="form-control" id="imageInput">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(get_setting('header_logo'))
                                                        <img src="{{ asset(get_setting('header_logo')->value) }}" width="180px" height="100px" id="" class="custom-img" alt="">
                                                    @else
                                                    <img src="{{ asset('backend/images/no-image.png') }}" width="180px" height="100px" id="" class="custom-img" alt="">
                                                    @endif
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Footer Logo<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="hidden" name="type[]" id="" value="footer_logo">
                                                                <input type="file" name="footer_logo"
                                                                    class="form-control" id="imageInput2">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                            @if(get_setting('footer_logo'))
                                                                <img src="{{ asset(get_setting('footer_logo')->value) }}" id=""  width="180px" height="100px" class="custom-img" alt="">
                                                            @else
                                                            <img src="{{ asset('backend/images/no-image.png') }}" width="180px" height="100px" id="" class="custom-img" alt="">
                                                            @endif
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Fav Icon<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="hidden" name="type[]" id="" value="fav_icon">

                                                                <input type="file" name="fav_icon"
                                                                    class="form-control" id="imageInput3">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(get_setting('fav_icon'))
                                                        <img src="{{ asset(get_setting('fav_icon')->value) }}" width="180px" height="100px" id="" class="custom-img" alt="">
                                                    @else
                                                    <img src="{{ asset('backend/images/no-image.png') }}" width="180px" height="100px" id="" class="custom-img" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-4 ">
                                        <div class="card p-4">
                                            <h4 class="pb-2 text-center" style="font-weight: bold;">Customer Discount Point Settings</h4>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Purchase Amount: <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="purchase_amount">
                                                        <input type="number" min="1" name="purchase_amount" value="{{ get_setting('purchase_amount')->value ?? '' }}" class="form-control " id="">
                                                        <span class="text-danger">@error('purchase_amount'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Purchase Point: <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="purchase_amount_point">
                                                        <input type="number" min="1" name="purchase_amount_point" value="{{ get_setting('purchase_amount_point')->value ?? '' }}" class="form-control " id="">
                                                        <span class="text-danger">@error('purchase_amount_point'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Point Discount : <small class="text-danger">*</small></label>
                                                        <input type="hidden" name="type[]" id="" value="point_amount_discount">
                                                        <input type="number" min="1" name="point_amount_discount" value="{{ get_setting('point_amount_discount')->value ?? '' }}" class="form-control " id="">
                                                        <span class="text-danger">@error('point_amount_discount'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">update</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
