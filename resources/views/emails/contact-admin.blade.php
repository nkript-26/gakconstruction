<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>New Contact Request</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f4f4;padding:20px;margin:0;">
    <div style="max-width:600px;margin:auto;background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,0.1);">
        <div style="background:linear-gradient(135deg,#c0392b,#e74c3c);color:#fff;padding:30px;text-align:center;">
            <h1 style="margin:0;">🔔 New Contact Request</h1>
            <p style="margin:10px 0 0;">You have a new inquiry!</p>
        </div>

        <div style="padding:30px;">
            <table style="width:100%;border-collapse:collapse;">
                <tr>
                    <td style="padding:12px;background:#f8f9fa;border-bottom:1px solid #eee;width:140px;"><strong>👤 Name:</strong></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;">{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td style="padding:12px;background:#f8f9fa;border-bottom:1px solid #eee;"><strong>📧 Email:</strong></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;">
                        <a href="mailto:{{ $contact->email }}" style="color:#c0392b;">{{ $contact->email }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:12px;background:#f8f9fa;border-bottom:1px solid #eee;"><strong>📱 Mobile:</strong></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;">
                        <a href="tel:{{ $contact->mobile }}" style="color:#c0392b;">{{ $contact->mobile }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:12px;background:#f8f9fa;border-bottom:1px solid #eee;vertical-align:top;"><strong>📝 Requirements:</strong></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;">{!! nl2br(e($contact->requirements)) !!}</td>
                </tr>
            </table>

            <div style="margin-top:25px;padding:15px;background:#fff3cd;border-left:4px solid #ffc107;border-radius:5px;">
                <strong>⏰ Received:</strong> {{ $contact->created_at->format('d M Y, h:i A') }}
            </div>

            <div style="text-align:center;margin-top:25px;">
                <a href="{{ url('/admin/contacts') }}" style="background:#c0392b;color:#fff;padding:12px 30px;text-decoration:none;border-radius:5px;display:inline-block;">
                    View in Admin Panel
                </a>
            </div>
        </div>

        <div style="background:#1a1a2e;color:#aaa;padding:15px;text-align:center;font-size:12px;">
            © {{ date('Y') }} GAK Construction Admin Panel
        </div>
    </div>
</body>
</html>