@extends('admin.master')
@section('package', 'active submenu')
@section('package_collapse', 'show')
@section('list', 'active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title">Holiday Package</div>
                        </div>
                        <div class="col-6 text-end">
                            <a data-bs-toggle="modal" data-bs-target="#translateModel" data-bs-toggle="tooltip" title=""
                                class="btn btn-primary" data-original-title="Edit Task">
                                Translate
                            </a>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    @if (!isset($holidayPackage))
                        <form action="{{ route('holiday.package.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" required name="title" value="{{ old('title') }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('title')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required
                                            name="price" value="{{ old('price') }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Validaty Date Start</label>
                                        <input type="date" required name="validaty_start"
                                            value="{{ old('validaty_start') }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('validaty_start')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Validaty Date End</label>
                                        <input type="date" required name="validaty_end" value="{{ old('validaty_end') }}"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('validaty_end')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Thambnail Image</label>
                                        <input type="file" accept="image/*" required name="thambnail_img"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('thambnail_img')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sliders Image</label>
                                        <input type="file" required accept="image/*" multiple name="slider_img[]"
                                            class="form-control" />
                                        <small class="text-danger">
                                            @error('slider_img[]')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Total Days</label>
                                        <input type="number" required min="1" name="total_days"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                            value="{{ old('total_days') }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('total_days')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Priority</label>
                                        <input type="number" min="1" name="priority"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                            value="{{ old('priority') }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('priority')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea required name="description" id="summernote" class="form-control" id="comment" rows="5">{{ old('description') }}</textarea>
                                        <small class="text-danger">
                                            @error('description')
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
                        <form action="{{ route('holiday.package.update', $holidayPackage->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" required name="title"
                                            value="{{ $holidayPackage->title }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('title')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" name="price" required
                                            value="{{ $holidayPackage->price }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Validaty Date Start</label>
                                        <input type="date" required name="validaty_start"
                                            value="{{ $holidayPackage->validaty_start }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('validaty_start')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Validaty Date End</label>
                                        <input type="date" required name="validaty_end"
                                            value="{{ $holidayPackage->validaty_end }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('validaty_end')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select Country</label>
                                        <select name="country_id" required class="form-select form-control"
                                            id="country_id">
                                            <option value="">select one</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if ($holidayPackage->country_id == $country->id) selected @endif>
                                                    {{ $country->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select City</label>
                                        <select name="city_id" required class="form-select form-control" id="city_id">
                                            <option value="">select one</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ($holidayPackage->city_id == $city->id) selected @endif>{{ $city->name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Thambnail Image</label>
                                        <input type="file" accept="image/*" name="thambnail_img"
                                            class="form-control mb-2" />
                                        <img src="{{ asset($holidayPackage->thambnail_img) }}" width="50"
                                            height="40" alt="">
                                        <small class="text-danger">
                                            @error('thambnail_img')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sliders Image</label>
                                        <input type="file" accept="image/*" multiple name="slider_img[]"
                                            class="form-control mb-2" />
                                        @php
                                            $images = json_decode($holidayPackage->slider_img, true);
                                        @endphp
                                        @if ($holidayPackage->slider_img)
                                            @foreach ($images as $image)
                                                <img src="{{ asset($image) }}" width="50" height="40"
                                                    alt="No Image">
                                            @endforeach
                                            <br>
                                        @endif
                                        <small class="text-danger">
                                            @error('slider_img[]')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Total Days</label>
                                        <input type="number" required min="1" name="total_days"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                            value="{{ $holidayPackage->total_days }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('total_days')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Priority</label>
                                        <input type="number" min="1" name="priority"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                            value="{{ $holidayPackage->priority }}" class="form-control" />
                                        <small class="text-danger">
                                            @error('priority')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" required id="summernote" class="form-control" id="comment" rows="5">{!! $holidayPackage->description !!}
                                        </textarea>
                                        @error('description')
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


    <div class="modal fade" id="translateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New language
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @php
                        $langs = App\Models\Language::where('status', 1)
                            ->where('lang_code', '!=', 'en')
                            ->orderBy('id', 'asc')
                            ->get();
                    @endphp

                    @if ($langs->isNotEmpty())
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($langs as $index => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                        id="{{ $lang->lang_code }}-tab" data-bs-toggle="tab"
                                        data-bs-target="#{{ $lang->lang_code }}" type="button" role="tab"
                                        aria-controls="{{ $lang->lang_code }}"
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                        {{ ucfirst($lang->name) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach ($langs as $index => $lang)
                                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                    id="{{ $lang->lang_code }}" role="tabpanel"
                                    aria-labelledby="{{ $lang->lang_code }}-tab">
                                    <form action="{{ route('store.translateData') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="model_name" value="App\Models\HolidayPackage">
                                        <input type="hidden" name="lang_code" value="{{ $lang->lang_code }}">
                                        <input type="hidden" name="key_id" value="{{ $holidayPackage->id }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" name="key_name[]" value="title">
                                                <div class="form-group">
                                                    <label for="">Title</label>
                                                    <input type="text" required name="value[]"
                                                        value="{{ $holidayPackage->DynamicTranslations->first(fn($translation) => $translation->key_name === 'title' && $translation->lang_code === $lang->lang_code)?->value ?? '' }}"
                                                        class="form-control" />
                                                    <small class="text-danger">
                                                        @error('title')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="hidden" name="key_name[]" value="description">
                                                <div class="form-group">
                                                    <label for="">Description</label>
                                                    <textarea name="value[]" required class="form-control summernoteClass" id="comment" rows="5">
                                                        {!! $holidayPackage->DynamicTranslations->first(
                                                            fn($translation) => $translation->key_name === 'description' && $translation->lang_code === $lang->lang_code,
                                                        )?->value ?? '' !!}
                                                    </textarea>
                                                    @error('description')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm pl-5">Update</button>
                                </div>
                                </form>
                            @endforeach
                        </div>
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
