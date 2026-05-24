<!doctype html>
<html>
<body style="margin: 0; padding: 0; background: #fafaf9; color: #111111; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background: #fafaf9; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 640px; background: #ffffff; border: 1px solid #eee7dd;">
                    <tr>
                        <td style="padding: 28px 32px; border-bottom: 1px solid #eee7dd;">
                            <p style="margin: 0 0 8px; color: #d97706; font-size: 11px; font-weight: 700; letter-spacing: 4px; text-transform: uppercase;">
                                Salon TwentyTwo
                            </p>
                            <h1 style="margin: 0; color: #111111; font-size: 28px; line-height: 1.1; font-weight: 900; letter-spacing: -1px; text-transform: uppercase;">
                                New Contact Message
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 32px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding: 0 0 20px;">
                                        <p style="margin: 0 0 7px; color: #9ca3af; font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;">Name</p>
                                        <p style="margin: 0; color: #111111; font-size: 16px; line-height: 1.5; font-weight: 700;">{{ $data['name'] }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 20px;">
                                        <p style="margin: 0 0 7px; color: #9ca3af; font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;">Email</p>
                                        <p style="margin: 0; color: #111111; font-size: 16px; line-height: 1.5;">
                                            <a href="mailto:{{ $data['email'] }}" style="color: #d97706; font-weight: 700; text-decoration: none;">{{ $data['email'] }}</a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 28px;">
                                        <p style="margin: 0 0 7px; color: #9ca3af; font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;">Subject</p>
                                        <p style="margin: 0; color: #111111; font-size: 16px; line-height: 1.5; font-weight: 700;">{{ $data['subject'] }}</p>
                                    </td>
                                </tr>
                            </table>

                            <div style="border-top: 1px solid #eee7dd; padding-top: 28px;">
                                <p style="margin: 0 0 12px; color: #9ca3af; font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;">Message</p>
                                <div style="background: #fafaf9; border-left: 4px solid #d97706; padding: 20px 22px;">
                                    <p style="margin: 0; color: #374151; font-size: 16px; line-height: 1.75; white-space: pre-line;">{{ $data['message'] }}</p>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 22px 32px; background: #111111;">
                            <p style="margin: 0; color: #ffffff; font-size: 12px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase;">
                                Reply directly to this email to contact the client
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
