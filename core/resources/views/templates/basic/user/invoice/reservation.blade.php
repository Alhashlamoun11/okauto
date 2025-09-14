<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #{{ $reservation->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
        }

        .invoice-container {
            background: #fff;
            max-width: 800px;
            margin: 30px auto;
            padding: 30px 40px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #439cf9;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header img {
            max-height: 50px;
        }

        .header .site-name {
            font-size: 22px;
            font-weight: bold;
            color: #439cf9;
        }

        h2 {
            margin-top: 0;
            color: #444;
        }

        h3 {
            color: #333;
            margin-bottom: 5px;
        }

        p {
            margin: 5px 0 15px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th {
            background: #439cf9;
            color: white;
            text-align: left;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-weight: bold;
            font-size: 16px;
            color: #000;
        }

        .footer-note {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
<div class="invoice-container">

    <!-- Header -->
    <div class="header">
        <div class="site-name">{{ config('app.name', 'OkAuto') }}</div>
    </div>

    <h2>Invoice #{{ $reservation->id }}</h2>
    <p><strong>Date of Issue:</strong> {{ showDateTime(now()) }}</p>

    <!-- Renter -->
    <h3>Renter</h3>
    <p>
        {{ $reservation->user->fullname }}<br>
        {{ $reservation->user->email }}<br>
        {{ $reservation->user->phone }}
    </p>

    <!-- Vehicle Owner -->
    <h3>Vehicle Owner</h3>
    <p>
        {{ $reservation->vehicleOwner->fullname }}<br>
        {{ $reservation->vehicleOwner->email }}<br>
        {{ $reservation->vehicleOwner->phone }}
    </p>

    <!-- Vehicle -->
    <h3>Vehicle</h3>
    <p>
        {{ $reservation->vehicle->name }} ({{ $reservation->vehicle->vehicleType->name }})<br>
        <strong>Pickup:</strong> {{ $reservation->start_date }} {{$reservation->pickup_time}}<br>
        <strong>Drop-off:</strong> {{ ($reservation->end_date) }} {{$reservation->dropoff_time}}
    </p>
    @if($deposit!=null)

        <h3>Transaction Number: #{{ $deposit->trx }}</h3>

        @if($reservation->extraServices)
    <h3>Services</h3>

    <table>
        <thead>
        <tr>
            <th>Service Name</th>
            <th class="text-right">Amount</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservation->extraServices as $extraService)
        <tr >
        <td>{{__($extraService->extraService->name)}}</td>
        <td class="text-right">{{showAmount(($extraService->price))}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

        @endif

    <!-- Charges -->
    <h3>Charges</h3>
    
    <table>
        <thead>
        <tr>
            <th>Description</th>
            <th class="text-right">Amount</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Base Price</td>
            <td class="text-right">{{ showAmount($deposit->amount) }}</td>
        </tr>
        @if($reservation->extraServices)
            <tr>
                <td>Extra Services</td>
                <td class="text-right">{{ showAmount($reservation->extra_services_amount) }}</td>
            </tr>
        @endif
        @if($deposit->coupon_discount)
            <tr>
                <td>Coupon Discount</td>
                <td class="text-right">-{{ showAmount($deposit->coupon_discount) }}</td>
            </tr>
        @endif
        @if($deposit->tax)
            <tr>
                <td>Tax</td>
                <td class="text-right">{{ showAmount($deposit->tax) }}</td>
            </tr>
        @endif
        @if($deposit->charge )
            <tr>
                <td>Charge</td>
                <td class="text-right">{{ showAmount($deposit->charge ) }}</td>
            </tr>
        @endif
        <tr>
            <td class="total">Total</td>
            <td class="text-right total">{{ showAmount($deposit->final_amount) }}</td>
        </tr>
        </tbody>
    </table>

@endif
    <!-- Footer -->
    <div class="footer-note">
        Thank you for using {{ config('app.name', 'CarRentalPro') }}. If you have any questions, please contact our support.
    </div>

</div>
</body>
</html>
