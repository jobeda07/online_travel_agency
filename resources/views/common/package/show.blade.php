@extends('admin.master')
@section('package', 'active submenu')
@section('package_collapse', 'show')
@section('list','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-item-center">
                    <h4 class="card-title"> Holaday Package Details</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary  mt-4">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Validaty Start</th>
                                        <th>Validaty End</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Priority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $holidayPackage->title ?? '' }}</td>
                                        <td>{{ $holidayPackage->price ?? '' }}</td>
                                        <td>{{ $holidayPackage->validaty_start ?? '' }}</td>
                                        <td>{{ $holidayPackage->validaty_end ?? '' }}</td>
                                        <td>{{ $holidayPackage->country->name_en ?? '' }}</td>
                                        <td>{{ $holidayPackage->city->name_en ?? '' }}</td>
                                        <td>{{ $holidayPackage->priority ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary  mt-4">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{!! $holidayPackage->description ?? 'N/A' !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-head-bg-secondary  mt-4">
                                <thead>
                                    <tr>
                                        <th>Thambnail Image</th>
                                        <th>Sliders Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="{{asset($holidayPackage->thambnail_img)}}" width="80" height="50" alt=""></td>
                                        <td>
                                            @php
                                            $images = json_decode($holidayPackage->slider_img, true);
                                            @endphp
                                            @if($holidayPackage->slider_img)
                                                @foreach($images as $image)
                                                    <img src="{{ asset($image) }}" width="80" height="50" alt="No Image">
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
