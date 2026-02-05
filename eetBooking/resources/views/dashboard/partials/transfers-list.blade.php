@foreach($transferBookings as $booking)
  <div class="p-4 rounded-xl border border-gray-100 hover:border-blue-100 transition hover:shadow-md bg-white group">
    <div class="flex items-center justify-between mb-2">
      <span class="text-xs font-bold text-gray-400">TRANSFER • {{ $booking->booking_reference }}</span>
      @php
        $statusColors = [
          'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
          'confirmed' => 'bg-green-50 text-green-700 border-green-200',
          'cancelled' => 'bg-red-50 text-red-700 border-red-200',
        ];
        $statusIcons = [
          'pending' => 'fa-clock',
          'confirmed' => 'fa-check-circle',
          'cancelled' => 'fa-circle-xmark',
        ];
        $color = $statusColors[$booking->status] ?? 'bg-gray-50 text-gray-700 border-gray-200';
        $icon = $statusIcons[$booking->status] ?? 'fa-circle-info';
      @endphp
      <span
        class="px-3 py-1 {{ $color }} border text-xs font-bold rounded-full uppercase inline-flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid {{ $icon }}"></i>
        {{ ucfirst($booking->status) }}
      </span>
    </div>
    <div class="flex items-center gap-4">
      <div class="flex-1">
        <div class="text-lg font-bold text-gray-900 flex items-center gap-2">
          {{ $booking->pickup_location }}
          <i class="fa-solid fa-arrow-right text-gray-300 text-sm"></i>
          {{ $booking->dropoff_location }}
        </div>
        <div class="text-sm text-gray-500 mt-1 flex items-center gap-4">
          <span class="flex items-center gap-1"><i class="fa-regular fa-calendar"></i>
            {{ $booking->pickup_date->format('M d, Y') }}</span>
          <span class="flex items-center gap-1"><i class="fa-solid fa-car-side"></i>
            {{ $booking->vehicle_type ?? 'Standard' }}</span>
        </div>
      </div>
    </div>
  </div>
@endforeach