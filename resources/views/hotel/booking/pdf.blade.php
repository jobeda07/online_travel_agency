<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #000;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
            padding: 5px;
            border-radius: 3px;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
            padding: 5px;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <div class="invoice-header">
                <h2>Invoice</h2>
                <img src="{{ public_path('admin/assets/img/kaiadmin/logo_light.svg') }}" alt="Logo" width="135"
                    height="44">
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <div style="flex: 1; margin-right: 20px;">
                    <h4>From</h4>
                    <address>
                        <strong>BootstrapBrain</strong><br>
                        875 N Coast Hwybr<br>
                        Laguna Beach, California, 92651<br>
                        United States<br>
                        Phone: (949) 494-7695<br>
                        Email: email@domain.com
                    </address>
                </div>

                <div style="flex: 1; text-align: right;">
                    <h4>Bill To</h4>
                    <address>
                        <strong>Mason Carter</strong><br>
                        7657 NW Prairie View Rd<br>
                        Kansas City, Mississippi, 64151<br>
                        United States<br>
                        Phone: (816) 741-5790<br>
                        Email: email@client.com
                    </address>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Hotel Code</th>
                        <th>Booking Code</th>
                        <th>Check In</th>
                        <th>Check Out</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $hotelBooking->customer->first_name ?? '' }}
                            {{ $hotelBooking->customer->last_name ?? '' }}
                        </td>
                        <td>{{ $hotelBooking->customer->phone ?? '' }}</td>
                        <td>{{ $hotelBooking->hotel_code ?? '' }}</td>
                        <td>{{ $hotelBooking->booking_code ?? '' }}</td>
                        <td>{{ $hotelBooking->checkin_date ?? '' }}</td>
                        <td>{{ $hotelBooking->checkout_date ?? '' }}</td>

                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>City</th>
                        <th>Room No</th>
                        <th>Room Type</th>
                        <th>No Of Adult</th>
                        <th>No Of Child</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $hotelBooking->country->name_en ?? '' }}</td>
                        <td>{{ $hotelBooking->city->name_en ?? '' }}</td>
                        <td>{{ $hotelBooking->room_no ?? '' }}</td>
                        <td>{{ $hotelBooking->room_type->display() ?? '' }}</td>
                        <td>{{ $hotelBooking->no_of_adult ?? '' }}</td>
                        <td>{{ $hotelBooking->no_of_child ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>Adult Base Price</th>
                        <th>City</th>
                        <th>Total Price</th>
                        <th>Discount Amount</th>
                        <th>vat</th>
                        <th>Extra Charge</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $hotelBooking->adult_base_price ?? '' }}</td>
                        <td>{{ $hotelBooking->child_base_price?? '' }}</td>
                        <td>{{ $hotelBooking->total_price ?? '' }}</td>
                        <td>{{ $hotelBooking->discount_amount ?? '' }}</td>
                        <td>{{ $hotelBooking->vat ?? '' }}</td>
                        <td>{{ $hotelBooking->extra_charge ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>Grand Total</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $hotelBooking->grand_total ?? '' }}</td>
                        <td>{{ $hotelBooking->paid_amount ?? '' }}</td>
                        <td>{{ $hotelBooking->grand_total-$hotelBooking->paid_amount }}</td>
                        <td>{{ $hotelBooking->payment_method->display() ?? '' }}</td>
                        <td>{{ $hotelBooking->payment_status ?? '' }}</td>
                        <td>
                            @if ($hotelBooking->status == 1)
                                <a 
                                    class="badge badge-success">active</a>
                            @else
                                <a
                                    class="badge badge-danger">Inactive</a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>Charge Details</th>
                        <th>Payment Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $hotelBooking->extra_charge_details ?? '' }}</td>
                        <td>{{ $hotelBooking->payment_details ?? '' }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </section>
</body>

</html>
