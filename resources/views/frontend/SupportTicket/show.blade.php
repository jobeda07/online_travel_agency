@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('supportTicket.list') }}">{{ __('List') }}</a>
                        <a href="{{ route('supportTicket.create.newMessage', $supportTicket->id) }}" class="btn btn-info">New
                            Message</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Message</th>
                                    <th>Send By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($support_messages as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->message }}
                                            @php
                                                $images = json_decode($item->image, true);
                                            @endphp
                                            @if ($item->image)
                                                @foreach ($images as $image)
                                                    <img src="{{ asset($image) }}" width="120" height="70"
                                                        alt="No Image">
                                                @endforeach
                                                <br>
                                            @endif

                                            @if ($item->attachment)
                                                <a href="{{ asset($item->attachment) }}"
                                                    class="btn btn-primary btn-sm ms-auto mt-3" target="_blank">View PDF</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->send_by_customer)
                                                {{ $item->customer->first_name ?? 'Customer' }}
                                            @elseif($item->send_by_adminUser)
                                                {{ $item->user->name ?? 'Admin' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
