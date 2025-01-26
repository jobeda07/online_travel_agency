@extends('admin.master')
@section('support_ticket', 'active')
@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">New Message</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('adminSupportTicket.store.newMessage', $supportTicket->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="image[]" multiple class="form-control" />
                                    <small class="text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">File (PDF)</label>
                                    <input type="file" name="attachment" value="{{ old('attachment') }}"
                                        class="form-control" />
                                    <small class="text-danger">
                                        @error('attachment')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Message</label>
                                    <textarea name="message" class="form-control" id="comment" rows="5">{{ old('message') }}
                                        </textarea>
                                    <small class="text-danger">
                                        @error('message')
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
                </div>
            </div>
        </div>
    </div>
@endsection
