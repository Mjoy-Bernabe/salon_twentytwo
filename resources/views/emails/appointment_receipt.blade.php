<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background:#f9fafb; margin:0; padding:0; }
        .wrapper { max-width:600px; margin:40px auto; background:#fff; border:1px solid #e5e7eb; }
        .header { background:#111; padding:32px; text-align:center; }
        .header h1 { color:#fff; font-size:22px; margin:0; letter-spacing:-0.02em; }
        .header span { color:#eab308; font-weight:300; }
        .accent { height:3px; background:#eab308; }
        .body { padding:32px; }
        .greeting { font-size:15px; color:#111; font-weight:700; margin:0 0 8px; }
        .intro { font-size:14px; color:#6b7280; line-height:1.7; margin:0 0 24px; }
        .box { background:#fafaf9; border:1px solid #e5e7eb; margin-bottom:24px; }
        .row td { border-bottom:1px solid #f3f4f6; }
        .label { padding:12px 20px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af; }
        .value { padding:12px 20px; font-size:13px; font-weight:700; color:#111; text-align:right; }
        .total-label { padding:14px 20px; font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#111; }
        .total-value { padding:14px 20px; font-size:18px; font-weight:900; color:#111; text-align:right; }
        .footer { background:#f9fafb; border-top:1px solid #f3f4f6; padding:20px 32px; text-align:center; font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.1em; }
    </style>
</head>
<body>
@php
    $total = $appointment->services->sum('price');
    $paid = $total;
@endphp
<div class="wrapper">
    <div class="header">
        <h1>Salon<span>TwentyTwo</span></h1>
    </div>
    <div class="accent"></div>
    <div class="body">
        <p class="greeting">Hello, {{ $appointment->customer->name }}!</p>
        <p class="intro">
            Your appointment has been completed and fully paid. Here is your receipt for your SalonTwentyTwo visit.
        </p>

        <table width="100%" cellpadding="0" cellspacing="0" class="box">
            <tr class="row">
                <td class="label">Service</td>
                <td class="value">{{ $appointment->services->pluck('service_name')->join(', ') }}</td>
            </tr>
            <tr class="row">
                <td class="label">Receipt No.</td>
                <td class="value">#{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr class="row">
                <td class="label">Appointment</td>
                <td class="value">{{ $appointment->appointment_datetime->format('F j, Y') }}<br>{{ $appointment->appointment_datetime->format('g:i A') }}</td>
            </tr>
            <tr class="row">
                <td class="label">Stylist</td>
                <td class="value">{{ $appointment->stylist->name }}</td>
            </tr>
            <tr>
                <td class="label">Completed</td>
                <td class="value">{{ $appointment->updated_at->format('F j, Y g:i A') }}</td>
            </tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" class="box">
            @foreach($appointment->services as $service)
            <tr class="row">
                <td class="label">{{ $service->service_name }}</td>
                <td class="value">&#8369;{{ number_format($service->price, 2) }}</td>
            </tr>
            @endforeach
            <tr class="row">
                <td class="total-label">Total</td>
                <td class="total-value">&#8369;{{ number_format($total, 2) }}</td>
            </tr>
            <tr class="row">
                <td class="total-label">Amount Paid</td>
                <td class="total-value" style="color:#047857;">&#8369;{{ number_format($paid, 2) }}</td>
            </tr>
        </table>

        <p class="intro" style="margin-bottom:0;">
            Thank you for visiting SalonTwentyTwo.
        </p>
    </div>
    <div class="footer">
        SalonTwentyTwo · Pasig City, Metro Manila
    </div>
</div>
</body>
</html>
