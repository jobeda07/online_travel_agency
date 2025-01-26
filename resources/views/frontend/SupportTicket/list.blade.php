@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('List') }}
                <a href="{{ route('supportTicket.create') }}" class="btn btn-info">New Support</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Support Token</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($support_tickets as $key=> $item)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $item->token }}</td>
                                    <td>
                                        <a href="{{ route('supportTicket.show',$item->id) }}">Show</a>
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
