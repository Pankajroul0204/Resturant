<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; background: #f9f9f9; padding: 0;">

    <!-- Header -->
    <div style="background: #4CAF50; color: #fff; padding: 20px; text-align: center; width: 100%;">
        <h1 style="margin: 0;">{{ config('app.name') }}</h1>
    </div>

    <!-- Content -->
    <div style="background: #fff; width: 100%; margin: 0; padding: 32px 0;">
        <div style="padding: 20px 32px;">
            <h2>Hello {{ $data['name'] }},</h2>
            <p>Thank you for booking a table with us! Here are your booking details:</p>

            <table style="border-collapse: collapse; margin-top: 15px; margin-left: auto; margin-right: auto;">
                <tr>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Booking ID</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">{{ $data['booking_id'] }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Date & Time</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">
                        {{ $data['booking_datetime'] }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Number of peoples</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">
                        {{ $data['number_of_people'] }}</td>
                </tr>
            </table>

            <p>Total Amount: <strong>₹1000</strong></p>

            <p style="margin-top: 20px;">
                <a href="{{$data['payment_url']}}"
                    style="display: inline-block; padding: 12px 20px; background: #4CAF50; text-decoration: none; border-radius: 6px; font-weight: bold; color: #fff !important;">Complete
                    Payment</a>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div style="background: #333; color: #ccc; padding: 10px; text-align: center; font-size: 12px; width: 100%;">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>

</body>

</html>
