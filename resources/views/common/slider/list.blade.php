@extends('admin.master')
@section('frontend', 'active submenu')
@section('frontend_collapse', 'show')
@section('subnav1', 'show')
@section('slider','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Slider List</h4>
                    <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fa fa-plus"></i>Add
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Image / Video</th>
                                <th>Status</th>
                                <th style="width:30%;text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($sliders) > 0)
                                @foreach ($sliders as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->title ?? '' }}</td>
                                        <td>
                                            @if ($item->image)
                                                <img src="{{ asset($item->image) }}" width="140" height="80"
                                                    alt="no">
                                            @elseif($item->video)
                                                <video width="200" height="140" controls autoplay muted>
                                                    <source src="{{ asset($item->video) }}" type="video/mp4">
                                                </video>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                                <a href="{{ route('slider.status', $item->id) }}"
                                                    class="badge badge-success">active</a>
                                            @else
                                                <a href="{{ route('slider.status', $item->id) }}"
                                                    class="badge badge-danger">Inactive</a>
                                            @endif
                                        </td>
                                        <td class="">
                                            <div class="">
                                                <a data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                                                    data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">New Role</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('slider.update', $item->id) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Name</label>
                                                                                <input type="text" required
                                                                                    name="title"
                                                                                    value="{{ $item->title }}"
                                                                                    class="form-control" id=""
                                                                                    placeholder="Enter title" />
                                                                                <small class="text-danger">
                                                                                    @error('title')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="">Select One</label>
                                                                                <select name="slider_type" required
                                                                                    class="form-select form-control slider_type"
                                                                                    id="">
                                                                                    <option value="">select one
                                                                                    </option>
                                                                                    <option value="image">Image</option>
                                                                                    <option value="video">Video</option>
                                                                                </select>
                                                                                @error('slider_type')
                                                                                    {{ $message }}
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group show_input">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm pl-5">Update</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('slider.destroy', $item->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="deleteButton btn btn-link btn-danger"
                                                        data-bs-toggle="tooltip" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">No customer found!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" required name="title" value="{{ old('title') }}"
                                        class="form-control" id="" placeholder="Enter tilte" />
                                    <small class="text-danger">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Select One</label>
                                    <select name="slider_type" required class="form-select form-control slider_type"
                                        id="">
                                        <option value="">select one</option>
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                    @error('slider_type')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group show_input">

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
{{-- @push('script')
<script>
      $(document).on('change', '.slider_type', function(){
        let slider_type = $(this).val();
        if(slider_type === 'image'){
            $('.show_input').html(`
                <label>Image</label>
                <input type="file" required accept="image/*" name="image" class="form-control"/>
                <small class="text-danger">
                    @error('image')
                        {{ $message }}
                    @enderror
                </small>
            `);
        } else if(slider_type === 'video') {
            $('.show_input').html(`
                <label>Video</label>
                <input type="file" required name="video" accept="video/*" class="form-control"/>
                <small class="text-danger">
                    @error('video')
                        {{ $message }}
                    @enderror
                </small>
            `);
        } else {
            $('.show_input').html('');
        }
    });
</script>
    
@endpush --}}
@push('script')
    <script>
        $(document).on('change', '.slider_type', function() {
            let slider_type = $(this).val();
            let showInputDiv = $(this).closest('.modal-body').find(
            '.show_input'); // Target the specific modal instance

            if (slider_type === 'image') {
                showInputDiv.html(`
                <label>Image</label>
                <input type="file" required accept="image/*" name="image" class="form-control"/>
                <small class="text-danger">
                    @error('image')
                        {{ $message }}
                    @enderror
                </small>
            `);
            } else if (slider_type === 'video') {
                showInputDiv.html(`
                <label>Video</label>
                <input type="file" required name="video" accept="video/*" class="form-control"/>
                <small class="text-danger">
                    @error('video')
                        {{ $message }}
                    @enderror
                </small>
            `);
            } else {
                showInputDiv.html('');
            }
        });
    </script>
@endpush
