@extends('admin.master')
@section('support_ticket', 'active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Support Conversation , Token No: {{ $supportTicket->token }} </h4>
                    <a href="{{ route('adminSupportTicket.create.newMessage', $supportTicket->id) }}"
                        class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Send Message
                    </a>
                </div>
            </div>
            <div class="card-body p-5 border-5">
                @if (count($support_messages) > 0)
                    @foreach ($support_messages as $key => $item)
                        <div class="separator-dashed"></div>
                        @if ($item->send_by_adminUser)
                            <div class="d-flex">
                                <div class="avatar avatar-offline">
                                    <span
                                        class="avatar-title rounded-circle border border-white bg-secondary">{{ $supportTicket->assigned_to }}</span>
                                </div>
                                <div class="flex-1 ms-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">
                                        {{ $item->user->name ?? ''}}
                                    </h6>
                                    <span class="text-muted">{{ $item->message }}</span><br>
                                    @php
                                        $images = json_decode($item->image, true);
                                    @endphp
                                    @if ($item->image)
                                        @foreach ($images as $image)
                                            <img src="{{ asset($image) }}" width="120" height="70" alt="No Image">
                                        @endforeach
                                        <br>
                                    @endif
                                    @if ($item->attachment)
                                        <a href="{{ asset($item->attachment) }}" class="btn btn-primary btn-sm ms-auto mt-3"
                                            target="_blank">View PDF</a>
                                    @endif
                                </div>
                                <div class="float-end pt-1">
                                    <small class="text-muted">{{ $item->created_at->format('M j, Y h:i A') }}</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                        @elseif($item->send_by_customer)
                            <div class="d-flex">
                                <div class="float-start pt-1">
                                    <small class="text-muted">{{ $item->created_at->format('M j, Y h:i A') }}</small>
                                </div>
                                <div class="flex-1 me-3 pt-1 text-end">
                                    <h6 class="text-uppercase fw-bold mb-1">
                                        {{ $item->customer->first_name ?? 'Customer' }}
                                    </h6>
                                    <span class="text-muted">{{ $item->message }} <br></span>
                                    @php
                                        $images = json_decode($item->image, true);
                                    @endphp
                                    @if ($item->image)
                                        @foreach ($images as $image)
                                            <img src="{{ asset($image) }}" width="120" height="70" alt="No Image">
                                        @endforeach
                                        <br>
                                    @endif
                                    @if ($item->attachment)
                                        <a href="{{ asset($item->attachment) }}"
                                            class="btn btn-primary btn-sm ms-auto mt-3" target="_blank">View PDF</a>
                                    @endif
                                </div>
                                <div class="avatar avatar-away">
                                    <span
                                        class="avatar-title rounded-circle border border-white bg-danger">{{ $supportTicket->send_by }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="separator-dashed"></div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
