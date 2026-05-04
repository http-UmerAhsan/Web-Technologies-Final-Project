<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Contact Form</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f4f4;margin:0;padding:20px">
<div style="max-width:560px;margin:0 auto;background:#fff;padding:40px;border-radius:4px">
  <h2 style="font-size:22px;color:#0a0a0a;margin:0 0 24px">[Nike Pakistan] New Contact Message</h2>
  <table style="width:100%;font-size:14px;border-collapse:collapse">
    <tr><td style="padding:10px 0;border-bottom:1px solid #f0f0f0;color:#888;width:120px">From</td><td style="padding:10px 0;border-bottom:1px solid #f0f0f0;font-weight:600">{{ $data['first_name'] }} {{ $data['last_name'] }}</td></tr>
    <tr><td style="padding:10px 0;border-bottom:1px solid #f0f0f0;color:#888">Email</td><td style="padding:10px 0;border-bottom:1px solid #f0f0f0">{{ $data['email'] }}</td></tr>
    <tr><td style="padding:10px 0;border-bottom:1px solid #f0f0f0;color:#888">Subject</td><td style="padding:10px 0;border-bottom:1px solid #f0f0f0">{{ $data['subject'] }}</td></tr>
  </table>
  <div style="margin-top:20px;background:#fafafa;padding:20px;border-left:4px solid #e63312;font-size:14px;line-height:1.7;color:#333">{{ $data['message'] }}</div>
</div>
</body></html>
