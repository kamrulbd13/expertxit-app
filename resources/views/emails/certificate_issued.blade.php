<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate Issued</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: 'Segoe UI', Roboto, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f6f8; padding: 40px 0;">
    <tr>
        <td align="center">
            <table width="700" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">

                <!-- Header -->
                <tr>
                    <td style="background-color: #28a745; padding: 25px 40px; text-align: center;">
                        <h1 style="color: #ffffff; font-size: 24px; margin: 0;">Your Certificate Has Been Issued</h1>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding: 40px; font-size: 16px; color: #333333; line-height: 1.6;">
                        <p>Dear <strong>{{ $mailData['name'] ?? 'Participant' }}</strong>,<br>
                            We hope you’re doing well. <br>
                        </p>


                        <p>We are pleased to inform you that your certificate for the following course has been officially issued:</p>

                        <table style="width: 100%; border: 1px solid #dddddd; border-collapse: collapse; margin: 20px 0;">
                            <tr>
                                <td style="padding: 10px; border: 1px solid #dddddd;"><strong>Participant Name</strong></td>
                                <td style="padding: 10px; border: 1px solid #dddddd;">{{ $mailData['name'] ?? '' }}</td>
                            </tr>
                            <tr style="background-color: #f9f9f9;">
                                <td style="padding: 10px; border: 1px solid #dddddd;"><strong>Course Name</strong></td>
                                <td style="padding: 10px; border: 1px solid #dddddd;">{{ $mailData['training_name'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #dddddd;"><strong>Issue Date</strong></td>
                                <td style="padding: 10px; border: 1px solid #dddddd;">{{ $mailData['certificate_issue_date'] ?? '' }}</td>
                            </tr>
                            <tr style="background-color: #f9f9f9;">
                                <td style="padding: 10px; border: 1px solid #dddddd;"><strong>Issued Status</strong></td>
                                <td style="padding: 10px; border: 1px solid #dddddd; color: green;"><strong>Done</strong></td>
                            </tr>
                        </table>

                        <p>If you have any questions regarding the course or your certificate, please don’t hesitate to reach out to our support team by replying to this email.</p>

                        <p>We appreciate your participation and look forward to supporting your continued learning journey.</p>

                        <p style="margin-top: 30px;">
                            Best regards,<br>
                            <strong>The Training & Support Team</strong><br>
                            {{ $mailData['site_name'] ?? 'Our Organization' }}
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color: #f1f1f1; padding: 20px 40px; text-align: center; font-size: 12px; color: #777;">
                        {{ $mailData['copy_right'] ?? '© ' . date('Y') . ' All rights reserved' }}<br>
                        For assistance, email us at <a href="mailto:{{ $mailData['mail2'] ?? '' }}" style="color: #003366; text-decoration: none;">{{ $mailData['mail2'] ?? '' }}</a><br>
                        Visit us at: <a href="{{ $mailData['website_link'] ?? '#' }}" style="color: #003366; text-decoration: none;">{{ $mailData['website_link'] ?? $mailData['site_name'] }}</a>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
