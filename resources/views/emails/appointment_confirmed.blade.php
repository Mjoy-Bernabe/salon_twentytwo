<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background:#f9fafb; margin:0; padding:0; }
        .wrapper { max-width:560px; margin:40px auto; background:#fff; border:1px solid #e5e7eb; }
        .header { background:#111; padding:32px; text-align:center; }
        .header h1 { color:#fff; font-size:22px; margin:0; letter-spacing:-0.02em; }
        .header h1 span { color:#eab308; font-weight:300; }
        .accent { height:3px; background:#eab308; }
        .body { padding:32px; }
        .greeting { font-size:15px; color:#111; font-weight:700; margin:0 0 8px; }
        .intro { font-size:14px; color:#6b7280; line-height:1.7; margin:0 0 24px; }
        .detail-box { background:#fafaf9; border:1px solid #e5e7eb; padding:20px 24px; margin-bottom:24px; }
        .detail-row { display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #f3f4f6; }
        .detail-row:last-child { border-bottom:none; }
        .detail-label { font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af; }
        .detail-value { font-size:13px; font-weight:700; color:#111; text-align:right; }
        .downpayment { background:#fefce8; border:1px solid #fde68a; padding:16px 24px; margin-bottom:24px; display:flex; justify-content:space-between; align-items:center; }
        .downpayment .label { font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#92400e; }
        .downpayment .amount { font-size:20px; font-weight:900; color:#111; }
        .note { font-size:12px; color:#9ca3af; line-height:1.7; margin:0 0 24px; font-style:italic; }
        .footer { background:#f9fafb; border-top:1px solid #f3f4f6; padding:20px 32px; text-align:center; font-size:11px; color:#d1d5db; text-transform:uppercase; letter-spacing:0.1em; }
    </style>
</head>
<body>
<div class="wrapper">
<div class="header">
    <h1 style="color:#fff; font-size:22px; margin:0; letter-spacing:-0.02em; font-family:Arial,sans-serif;">
        Salon<span style="color:#eab308; font-weight:300;">TwentyTwo</span>
    </h1>
</div>
    <div class="accent"></div>
    <div class="body">
        <p class="greeting">Hello, {{ $appointment->customer->name }}!</p>
        <p class="intro">
            Great news! Your appointment has been <strong>confirmed</strong>. 
            We look forward to seeing you. Here's a summary of your booking:
        </p>

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#fafaf9; border:1px solid #e5e7eb; margin-bottom:24px;">
            <tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:12px 24px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af; width:40%;">Service</td>
                <td style="padding:12px 24px; font-size:13px; font-weight:700; color:#111; text-align:right;">{{ $appointment->services->pluck('service_name')->join(', ') }}</td>
            </tr>
            <tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:12px 24px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af;">Stylist</td>
                <td style="padding:12px 24px; font-size:13px; font-weight:700; color:#111; text-align:right;">{{ $appointment->stylist->name }}</td>
            </tr>
            <tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:12px 24px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af;">Date & Time</td>
                <td style="padding:12px 24px; font-size:13px; font-weight:700; color:#111; text-align:right;">{{ $appointment->appointment_datetime->format('l, F j, Y') }}<br>{{ $appointment->appointment_datetime->format('g:i A') }}</td>
            </tr>
            <tr>
                <td style="padding:12px 24px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af;">Status</td>
                <td style="padding:12px 24px; font-size:13px; font-weight:700; color:#059669; text-align:right;">Confirmed ✓</td>
            </tr>
        </table>

        @php
            $total = $appointment->services->sum('price');
            $paid  = $appointment->downpayment_amount ?? 0;
            $remaining = $total - $paid;
        @endphp

        <table width="100%" cellpadding="0" cellspacing="0" style="background:#fafaf9; border:1px solid #e5e7eb; margin-bottom:24px;">
            <tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:12px 24px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af;">Total</td>
                <td style="padding:12px 24px; font-size:15px; font-weight:900; color:#111; text-align:right;">&#8369;{{ number_format($total, 2) }}</td>
            </tr>
            @if($paid > 0)
            <tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:12px 24px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af;">Downpayment Paid</td>
                <td style="padding:12px 24px; font-size:15px; font-weight:900; color:#059669; text-align:right;">&#8369;{{ number_format($paid, 2) }}</td>
            </tr>
            <tr>
                <td style="padding:12px 24px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#92400e; background:#fefce8;">Remaining Balance Due</td>
                <td style="padding:12px 24px; font-size:20px; font-weight:900; color:#111; text-align:right; background:#fefce8;">&#8369;{{ number_format($remaining, 2) }}</td>
            </tr>
            @else
            <tr>
                <td style="padding:12px 24px; font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:0.12em; color:#92400e; background:#fefce8;">Full Amount Due on the Day</td>
                <td style="padding:12px 24px; font-size:20px; font-weight:900; color:#111; text-align:right; background:#fefce8;">&#8369;{{ number_format($total, 2) }}</td>
            </tr>
            @endif
        </table>

        <p class="note">
            Please arrive 10 minutes before your scheduled time. Cancellations require at least 24 hours notice. 
            Prices may vary based on hair length and density.
        </p>
    </div>
    <div class="footer">
        SalonTwentyTwo · Pasig City, Metro Manila · Mon–Sun 10AM–10PM
    </div>
</div>
</body>
</html>
