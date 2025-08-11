<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration Approved</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: 'Segoe UI', Roboto, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding: 40px 0; background-color: #f4f6f8;">
    <tr>
        <td align="center">
            <table width="700" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.05); overflow: hidden;">

                <!-- Header -->
                <tr>
                    <td style="padding: 25px 40px; text-align: center;">
                        <h1 style="color: #2e7d32; font-size: 22px; margin: 0;">Registration Approved</h1>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding: 40px; font-size: 15px; color: #333333; line-height: 1.6;">
                        <p style="margin: 0;">
                            Dear <strong>{{ $mailData['name'] ?? '' }}</strong>,<br>
                            We hope you’re doing well.
                        </p>

                        <p>
                            We are pleased to inform you that your registration has been successfully reviewed and approved.
                            Your account is now active. You may log in to manage your profile, access your enrolled course, and take advantage of all available features via the link below:
                        </p>
                        <p>
                            <strong>Admin Panel:</strong>
                            <a href="{{ $mailData['website_link'] ?? '#' }}" style="color: #2e7d32; text-decoration: none;">
                                {{ $mailData['website_link'] ?? '' }}
                            </a><br>
                            <i><strong>Note:</strong> Please use your registered email address or phone number as your username to log in.</i>
                        </p>
                        <p>Should you have any questions regarding the course details, schedule, or access, please do not hesitate to reach out. We are here to assist you at every step.</p>

                        <p>We look forward to supporting your learning experience.</p>

                        <p style="margin-top: 30px;">
                            Best regards,<br>
                            <strong>Support Team</strong><br>
                            <b>{{ $mailData['site_name'] ?? '' }}</b>
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color: #f1f1f1; padding: 20px 40px; text-align: center; font-size: 12px; color: #777777;">
                        {{ $mailData['copy_right'] ?? '' }}.<br>
                        For assistance, contact us at <a href="mailto:{{ $mailData['mail2'] ?? ''  }}" style="color: #003366; text-decoration: none;">{{ $mailData['mail2'] ?? ''  }}</a><br>
                        Visit our website: <a href="{{ $mailData['website_link'] ?? '#' }}" style="color: #003366; text-decoration: none;">{{ $mailData['site_name'] ?? '' }}</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
