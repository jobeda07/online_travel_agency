@extends('admin.master')
@section('common', 'active submenu')
@section('common_collapse', 'show')
@section('language','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">{{ $language->name }} Language</h4>
                    <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fa fa-plus"></i>Add Language
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('language.translation.store', $language->lang_code) }}" method="post">
                    @csrf
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th> Key</th>
                                    <th> Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($key_values) > 0)
                                    @foreach ($key_values as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->description ?? '' }}</td>
                                            <td>
                                                <input type="hidden" name="key[]" value="{{ $item->key }}"
                                                    class="form-control" />
                                                <input type="text" required name="description[]"
                                                    value=" {{ optional($item->translations->first())->description ?? '' }}"
                                                    class="form-control" />
                                                <small class="text-danger">
                                                    @error('description')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No description found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm pl-5">Save</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('language.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" required name="name" value="{{ old('name') }}"
                                        class="form-control" id="" placeholder="Enter language Name" />
                                    <small class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Language Code</label>
                                    <input type="text" required name="lang_code" value="{{ old('lang_code') }}"
                                        class="form-control" id="" placeholder="Enter language Name" />
                                    <small class="text-danger">
                                        @error('lang_code')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm pl-5">Save</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
