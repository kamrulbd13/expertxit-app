<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Confirmation</title>
</head>
{{--@php dd($customerData); @endphp--}}
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: 'Segoe UI', Roboto, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f6f8; padding: 40px 0;">
    <tr>
        <td align="center">
            <table width="700" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); overflow: hidden;">

                <!-- Header -->
                <tr>
                    <td style="background-color: green; padding: 25px 40px; text-align: center;">
                        <h1 style="color: #ffffff; font-size: 24px; margin: 0;">Payment Verified Successfully</h1>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding: 40px; font-size: 16px; color: #333333; line-height: 1.8;">
                        <p style="margin: 0;">
                            Dear <strong>{{ $customerData['name'] ?? '' }}</strong>,<br>
                            We hope you’re doing well.
                        </p>

                        <p>We are writing to formally acknowledge the receipt and successful verification of your payment for the following course:</p>

                        <table style="width: 100%; border: 1px solid #dddddd; border-collapse: collapse; margin: 20px 0;">
                            <tr>
                                <td style="padding: 10px; border: 1px solid #dddddd;"><strong>Participant Name:</strong></td>
                                <td style="padding: 10px; border: 1px solid #dddddd;">{{ $customerData['name'] ?? '' }}</td>
                            </tr>
                            <tr style="background-color: #f9f9f9;">
                                <td style="padding: 10px; border: 1px solid #dddddd;"><strong>Course Name:</strong></td>
                                <td style="padding: 10px; border: 1px solid #dddddd;">{{ $customerData['training_name'] ?? '' }}</td>
                            </tr>
                            <tr style="background-color: #f9f9f9;">
                                <td style="padding: 10px; border: 1px solid #dddddd;"><strong>Payment Status:</strong></td>
                                <td style="padding: 10px; border: 1px solid #dddddd; color: green;"><strong>Verified</strong></td>
                            </tr>
                        </table>

                        <p>If you have any questions regarding the course content, schedule, or access details, our support team is here to assist you. Simply reply to this email or contact us using the information provided below.</p>

                        <p>We are delighted to have you as a participant and look forward to supporting your learning journey.</p>

                        <p style="margin-top: 30px;">Sincerely,<br><strong>The Training & Support Team</strong><br><b>{{ $customerData['site_name'] ?? '' }}</b></p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color: #f1f1f1; padding: 20px 40px; text-align: center; font-size: 12px; color: #777777;">
                        {{ $customerData['copy_right'] ?? '' }}.<br>
                        For support, email us at <a href="mailto:{{ $customerData['mail2'] ?? ''  }}" style="color: #003366; text-decoration: none;">{{ $customerData['mail2'] ?? ''  }}</a><br>
                        Visit our website: <a href="{{ $customerData['site_name'] ?? '' }}" style="color: #003366; text-decoration: none;">{{ $customerData['website_link'] ?? ''  }}</a>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
