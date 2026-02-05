@foreach($bookings as $booking)
  <div
    class="p-5 rounded-2xl border border-gray-100 hover:border-sky-100 transition hover:shadow-lg bg-white group relative overflow-hidden">
    <div class="absolute top-0 right-0 w-2 h-full bg-sky-500"></div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div>
        <span class="text-xs font-bold text-sky-600 uppercase tracking-wider mb-1 block">Package Trip</span>
        <h4 class="text-xl font-bold text-gray-900">{{ $booking->package->name_en ?? 'Holiday Package' }}</h4>
        <p class="text-sm text-gray-500 mt-1 flex items-center gap-2">
          <i class="fa-regular fa-calendar-alt text-sky-400"></i>
          Travel Date: {{ \Carbon\Carbon::parse($booking->travel_date)->format('M d, Y') }}
        </p>
      </div>
      <div class="text-right">
        <span class="block text-2xl font-black text-gray-900">${{ number_format($booking->total_price, 0) }}</span>
        @php
          $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'confirmed' => 'bg-green-100 text-green-700 border-green-200',
            'cancelled' => 'bg-red-100 text-red-700 border-red-200',
            'completed' => 'bg-blue-100 text-blue-700 border-blue-200',
          ];
          $statusIcons = [
            'pending' => 'fa-clock',
            'confirmed' => 'fa-check-circle',
            'cancelled' => 'fa-circle-xmark',
            'completed' => 'fa-flag-checkered',
          ];
          $color = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
          $icon = $statusIcons[$booking->status] ?? 'fa-circle-info';
        @endphp
        <span
          class="px-3 py-1 {{ $color }} border text-xs font-bold rounded-full uppercase inline-flex items-center gap-1.5 mt-2 shadow-sm">
          <i class="fa-solid {{ $icon }}"></i>
          {{ ucfirst($booking->status) }}
        </span>
      </div>
    </div>
  </div>
@endforeach