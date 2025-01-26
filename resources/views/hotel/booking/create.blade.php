@extends('admin.master')
@section('hotel_booking', 'active submenu')
@section('hotel_collapse', 'show')
@section('booking','active')
@section('content')
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Hotel Booking</div>
                </div>
                <div class="card-body">
                    @if (!isset($hotelBook))
                        <form action="{{ route('hotel.booking.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select Customers</label>
                                        <select name="customer_id" required class="form-select form-control"
                                            id="customer_id">
                                            <option value="">select one</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if (old('customer_id') == $customer->id) selected @endif>
                                                    {{ $customer->first_name }} {{ $customer->last_name }} (points :
                                                    {{ $customer->getUsablePoints() }})</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Point Discount</label>
                                        <input type="text" required name="point_discount" id="point_discount"
                                            value="{{ old('point_discount') }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('point_discount')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Booking Code</label>
                                        <input type="text" required name="booking_code" value="{{ old('booking_code') }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('booking_code')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Hotel Code</label>
                                        <input type="text" required name="hotel_code" value="{{ old('hotel_code') }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('hotel_code')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Room No</label>
                                        <input type="text" required name="room_no" value="{{ old('room_no') }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('room_no')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Room Type</label>
                                        <select name="room_type" required class="form-select form-control"
                                            id="defaultSelect">
                                            <option value="">select one</option>
                                            @foreach ($room_types as $room)
                                                <option value="{{ $room->value }}"
                                                    @if (old('room_type') == $room->value) selected @endif>
                                                    {{ $room->display() }}</option>
                                            @endforeach
                                        </select>
                                        @error('room_type')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">CheckIn Date</label>
                                        <input type="date" required name="checkin_date"
                                            value="{{ old('checkin_date') }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('checkin_date')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">CheckOut Date</label>
                                        <input type="date" name="checkout_date" value="{{ old('checkout_date') }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('checkout_date')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select Country</label>
                                        <select name="country_id" required class="form-select form-control" id="country_id">
                                            <option value="">select one</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if (old('country_id') == $country->id) selected @endif>
                                                    {{ $country->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select City</label>
                                        <select name="city_id" required class="form-select form-control" id="city_id">
                                            <option value="">select one</option>
                                        </select>
                                        @error('city_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">No Of Adult</label>
                                        <input type="text" required name="no_of_adult" value="{{ old('no_of_adult') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('no_of_adult')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">No Of Child</label>
                                        <input type="text" name="no_of_child" value="{{ old('no_of_child') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('no_of_child')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Adult Base Price</label>
                                        <input type="text" name="adult_base_price"
                                            value="{{ old('adult_base_price') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('adult_base_price')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Child Base Price</label>
                                        <input type="text" name="child_base_price"
                                            value="{{ old('child_base_price') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('child_base_price')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Total Price</label>
                                        <input type="text" name="total_price" value="{{ old('total_price') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('total_price')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Discount Amount</label>
                                        <input type="text" name="discount_amount"
                                            value="{{ old('discount_amount') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('discount_amount')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Vat</label>
                                        <input type="text" name="vat" value="{{ old('vat') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('vat')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Extra Charge</label>
                                        <input type="text" name="extra_charge" value="{{ old('extra_charge') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('extra_charge')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Extra Charge Details</label>
                                        <textarea name="extra_charge_details" class="form-control" id="comment" rows="5">{{ old('extra_charge_details') }}
                                        </textarea>
                                        <small class="text-danger">
                                            @error('extra_charge_details')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">paid Amount</label>
                                        <input type="text" name="paid_amount" value="{{ old('paid_amount') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('paid_amount')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select Payment Method</label>
                                        <select name="payment_method" class="form-select form-control" id="">
                                            <option value="">select one</option>
                                            @foreach ($payment_methods as $method)
                                                <option value="{{ $method->value }}"
                                                    @if (old('payment_method') == $method->value) selected @endif>
                                                    {{ $method->display() }}</option>
                                            @endforeach
                                        </select>
                                        @error('payment_method')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Payment Details</label>
                                        <textarea name="payment_details" class="form-control" id="comment" rows="5">{{ old('payment_details') }}
                                        </textarea>
                                        @error('payment_details')
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
                        <form action="{{ route('hotel.booking.update', $hotelBook->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="row p-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select Customers</label>
                                        <select name="customer_id" class="form-select form-control" id="defaultSelect">
                                            <option value="">select one</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if ($hotelBook->customer_id == $customer->id) selected @endif>
                                                    {{ $customer->first_name }} {{ $customer->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Booking Code</label>
                                        <input type="text" required name="booking_code"
                                            value="{{ $hotelBook->booking_code }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('booking_code')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Hotel Code</label>
                                        <input type="text" required name="hotel_code"
                                            value="{{ $hotelBook->hotel_code }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('hotel_code')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Room No</label>
                                        <input type="text" required name="room_no" value="{{ $hotelBook->room_no }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('room_no')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Room Type</label>
                                        <select name="room_type" required class="form-select form-control"
                                            id="defaultSelect">
                                            <option value="">select one</option>
                                            @foreach ($room_types as $room)
                                                <option value="{{ $room->value }}"
                                                    @if ($hotelBook->room_type === $room) selected @endif>
                                                    {{ $room->display() }}</option>
                                            @endforeach
                                        </select>
                                        @error('room_type')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">CheckIn Date</label>
                                        <input type="date" required name="checkin_date"
                                            value="{{ $hotelBook->checkin_date }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('checkin_date')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">CheckOut Date</label>
                                        <input type="date" name="checkout_date"
                                            value="{{ $hotelBook->checkout_date }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('checkout_date')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select Country</label>
                                        <select name="country_id" class="form-select form-control" id="country_id">
                                            <option value="">select one</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if ($hotelBook->country_id == $country->id) selected @endif>
                                                    {{ $country->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('name_bn')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select City</label>
                                        <select name="city_id" class="form-select form-control" id="city_id">
                                            <option value="">select one</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ($hotelBook->city_id == $city->id) selected @endif>{{ $city->name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">No Of Adult</label>
                                        <input type="text" required name="no_of_adult"
                                            value="{{ $hotelBook->no_of_adult }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('no_of_adult')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">No Of Child</label>
                                        <input type="text" name="no_of_child" value="{{ $hotelBook->no_of_child }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('no_of_child')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Adult Base Price</label>
                                        <input type="text" name="adult_base_price"
                                            value="{{ $hotelBook->adult_base_price }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('adult_base_price')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Child Base Price</label>
                                        <input type="text" name="child_base_price"
                                            value="{{ $hotelBook->child_base_price }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('child_base_price')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Total Price</label>
                                        <input type="text" name="total_price" value="{{ $hotelBook->total_price }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('total_price')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Discount Amount</label>
                                        <input type="text" name="discount_amount"
                                            value="{{ $hotelBook->discount_amount }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control" />
                                        <small class="text-danger">
                                            @error('discount_amount')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Vat</label>
                                        <input type="text" name="vat" value="{{ $hotelBook->vat }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('vat')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Extra Charge</label>
                                        <input type="text" name="extra_charge" value="{{ $hotelBook->extra_charge }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('extra_charge')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Extra Charge Details</label>
                                        <textarea name="extra_charge_details" class="form-control" id="comment" rows="5">{{ $hotelBook->extra_charge_details }}
                                        </textarea>
                                        <small class="text-danger">
                                            @error('extra_charge_details')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">paid Amount</label>
                                        <input type="text" name="paid_amount" value="{{ $hotelBook->paid_amount }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('paid_amount')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select Payment Method</label>
                                        <select name="payment_method" class="form-select form-control" id="">
                                            <option value="">select one</option>
                                            @foreach ($payment_methods as $method)
                                                <option value="{{ $method->value }}"
                                                    @if ($hotelBook->payment_method === $method) selected @endif>
                                                    {{ $method->display() }}</option>
                                            @endforeach
                                        </select>
                                        @error('payment_method')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Payment Details</label>
                                        <textarea name="payment_details" class="form-control" id="comment" rows="5">{{ $hotelBook->payment_details }}
                                        </textarea>
                                        @error('payment_details')
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
@push('script')
    <script>
        $(document).on('change', '#country_id', function() {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    url: "{{ url('/getcities') }}/" + country_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city_id"]').html(
                            '<option value="" selected="" disabled="">Select one</option>'
                        );
                        $.each(data, function(key, value) {
                            $('select[name="city_id"]').append(
                                '<option value="' + value.id + '">' + value.name_en +
                                '</option>'
                            );
                        });
                    }
                });
            } else {
                alert('danger');
            }
        });
    </script>
    <script>
        $(document).on('change', '#customer_id', function() {
            var selectedOption = $(this).find('option:selected');
            var points = selectedOption.data('points');
            $('#point_discount').val(points);
        });
        $(document).on('keyup', '#point_discount', function() {
            var selectedOption = $('#customer_id').find('option:selected');
            var maxPoints = selectedOption.data('points') || 0;
            if (maxPoints === 0) {
                $(this).val(0);
                return;
            }
            var value = parseInt($(this).val(), 10) || 0;
            if (value > maxPoints) {
                $(this).val(maxPoints);
            }
        });
    </script>
@endpush
