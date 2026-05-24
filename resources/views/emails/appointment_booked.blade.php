<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background:#f9fafb; margin:0; padding:0; }
        .wrapper { max-width:560px; margin:40px auto; background:#fff; border:1px solid #e5e7eb; }
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
        .status { background:#fef3c7; border:1px solid #fde68a; color:#92400e; padding:14px 20px; font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; margin-bottom:24px; text-align:center; }
        .footer { background:#f9fafb; border-top:1px solid #f3f4f6; padding:20px 32px; text-align:center; font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.1em; }
    </style>
</head>
<body>
@php
    $total = $appointment->services->sum('price');
    $paid = min((float) $appointment->downpayment_amount, (float) $total);
@endphp
<div class="wrapper">
    <div class="header">
        <h1>Salon<span>TwentyTwo</span></h1>
    </div>
    <div class="accent"></div>
    <div class="body">
        <p class="greeting">Hello, {{ $appointment->customer->name }}!</p>
        <p class="intro">
            We received your appointment request. Our team will review it and send another email once it is confirmed.
        </p>

        <div class="status">Pending Confirmation</div>

        <table width="100%" cellpadding="0" cellspacing="0" class="box">
            <tr class="row">
                <td class="label">Service</td>
                <td class="value">{{ $appointment->services->pluck('service_name')->join(', ') }}</td>
            </tr>
            <tr class="row">
                <td class="label">Stylist</td>
                <td class="value">{{ $appointment->stylist->name }}</td>
            </tr>
            <tr class="row">
                <td class="label">Date & Time</td>
                <td class="value">{{ $appointment->appointment_datetime->format('F j, Y') }}<br>{{ $appointment->appointment_datetime->format('g:i A') }}</td>
            </tr>
            <tr class="row">
                <td class="label">Total</td>
                <td class="value">&#8369;{{ number_format($total, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Downpayment</td>
                <td class="value">&#8369;{{ number_format($paid, 2) }}</td>
            </tr>
        </table>

        <p class="intro" style="margin-bottom:0;">
            Please wait for your confirmation email before considering the appointment final.
        </p>
    </div>
    <div class="footer">
        SalonTwentyTwo · Pasig City, Metro Manila
    </div>
</div>
</body>
</html>
