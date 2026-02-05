<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
    }

    .header {
      background: #0ea5e9;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .content {
      padding: 20px;
    }

    .label {
      font-weight: bold;
      color: #555;
    }

    .value {
      margin-bottom: 15px;
      display: block;
    }

    .destinations {
      background: #f0f9ff;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .footer {
      font-size: 12px;
      color: #777;
      margin-top: 30px;
      text-align: center;
      border-top: 1px solid #eee;
      padding-top: 10px;
    }
  </style>
</head>

<body>
  <div class="header">
    <h2>New Custom Package Request</h2>
  </div>

  <div class="content">
    <p>You have received a new inquiry for a custom holiday package.</p>

    <div class="destinations">
      <span class="label">Selected Destinations:</span>
      <div class="value">
        @if(!empty($data['selected_destination_names']))
          {{ implode(', ', $data['selected_destination_names']) }}
        @else
          None selected from list
        @endif
      </div>

      @if(!empty($data['other_destination']))
        <span class="label">Other Destination Request:</span>
        <div class="value">{{ $data['other_destination'] }}</div>
      @endif
    </div>

    <span class="label">Client Name:</span>
    <span class="value">{{ $data['name'] }}</span>

    <span class="label">Email:</span>
    <span class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></span>

    <span class="label">Phone / WhatsApp:</span>
    <span class="value">{{ $data['phone'] }}</span>

    <hr>

    <span class="label">Arrival Date:</span>
    <span class="value">{{ $data['arrival_date'] }}</span>

    <span class="label">Duration:</span>
    <span class="value">{{ $data['duration'] }} Days</span>

    <span class="label">Travelers:</span>
    <span class="value">{{ $data['adults'] }} Adults, {{ $data['children'] ?? 0 }} Children</span>

    <span class="label">Budget:</span>
    <span class="value">{{ $data['budget'] ?? 'Not specified' }}</span>

    <span class="label">Additional Notes:</span>
    <span class="value">{{ nl2br(e($data['notes'] ?? 'None')) }}</span>
  </div>

  <div class="footer">
    Received via Egypt Express Travel Website
  </div>
</body>

</html>