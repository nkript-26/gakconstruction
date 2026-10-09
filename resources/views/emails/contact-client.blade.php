<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Thank You</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f4f4;padding:20px;margin:0;">
    <div style="max-width:600px;margin:auto;background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,0.1);">
        <div style="background:linear-gradient(135deg,#c0392b,#e74c3c);color:#fff;padding:40px;text-align:center;">
            <h1 style="margin:0;">✅ Thank You, {{ $contact->name }}!</h1>
            <p style="margin:10px 0 0;font-size:16px;">Your inquiry has been received</p>
        </div>

        <div style="padding:30px;">
            <p style="font-size:16px;color:#333;">Dear <strong>{{ $contact->name }}</strong>,</p>
            <p style="color:#555;line-height:1.7;">
                Thank you for reaching out to <strong>GAK Construction</strong>. We have received your inquiry
                and our team will contact you within <strong>24 hours</strong>.
            </p>

            <h3 style="color:#c0392b;border-bottom:2px solid #c0392b;padding-bottom:8px;margin-top:25px;">
                📋 Your Submission Details
            </h3>

            <table style="width:100%;border-collapse:collapse;margin-top:15px;">
                <tr>
                    <td style="padding:10px;background:#f8f9fa;width:130px;"><strong>Name:</strong></td>
                    <td style="padding:10px;">{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td style="padding:10px;background:#f8f9fa;"><strong>Email:</strong></td>
                    <td style="padding:10px;">{{ $contact->email }}</td>
                </tr>
                <tr>
                    <td style="padding:10px;background:#f8f9fa;"><strong>Mobile:</strong></td>
                    <td style="padding:10px;">{{ $contact->mobile }}</td>
                </tr>
                <tr>
                    <td style="padding:10px;background:#f8f9fa;vertical-align:top;"><strong>Requirements:</strong></td>
                    <td style="padding:10px;">{!! nl2br(e($contact->requirements)) !!}</td>
                </tr>
            </table>

            <div style="margin-top:30px;padding:20px;background:#f8f9fa;border-radius:8px;text-align:center;">
                <p style="margin:0;color:#333;"><strong>📞 Need urgent assistance?</strong></p>
                <p style="margin:5px 0;color:#c0392b;font-size:20px;"><strong>+94 77 123 4567</strong></p>
                <p style="margin:5px 0;color:#666;font-size:14px;">Mon - Sat: 8:00 AM - 6:00 PM</p>
            </div>

            <p style="margin-top:30px;color:#555;">
                Best Regards,<br>
                <strong>GAK Construction Team</strong>
            </p>
        </div>

        <div style="background:#1a1a2e;color:#aaa;padding:20px;text-align:center;font-size:12px;">
            © {{ date('Y') }} GAK Construction. All Rights Reserved.<br>
            123 Construction Lane, Colombo, Sri Lanka
        </div>
    </div>
</body>
</html>