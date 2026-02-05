<!DOCTYPE html>
<html>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

  <h2 style="color: #0284c7;">New Inquiry from Egypt Express Travel Website</h2>

  <p><strong>Name:</strong> {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
  <p><strong>Email:</strong> {{ $data['email'] }}</p>
  <p><strong>Subject:</strong> {{ $data['subject'] }}</p>

  <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

  <h3>Message:</h3>
  <div style="background: #f9fafb; padding: 15px; border-radius: 8px; border-left: 4px solid #0284c7;">
    {{ nl2br(e($data['message'])) }}
  </div>

</body>

</html>