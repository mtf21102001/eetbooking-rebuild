@foreach($visaApplications as $application)
  <div class="p-4 rounded-xl border border-gray-100 hover:border-orange-100 transition hover:shadow-md bg-white group">
    <div class="flex items-center justify-between mb-2">
      <span class="text-xs font-bold text-gray-400">VISA • {{ $application->application_reference }}</span>
      @php
        $statusColors = [
          'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
          'approved' => 'bg-green-50 text-green-700 border-green-200',
          'rejected' => 'bg-red-50 text-red-700 border-red-200',
        ];
        $statusIcons = [
          'pending' => 'fa-hourglass-half',
          'approved' => 'fa-stamp',
          'rejected' => 'fa-ban',
        ];
        $color = $statusColors[$application->status] ?? 'bg-gray-50 text-gray-700 border-gray-200';
        $icon = $statusIcons[$application->status] ?? 'fa-circle-info';
      @endphp
      <span
        class="px-3 py-1 {{ $color }} border text-xs font-bold rounded-full uppercase inline-flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid {{ $icon }}"></i>
        {{ ucfirst($application->status) }}
      </span>
    </div>
    <div class="flex items-center gap-4">
      <div class="flex-1">
        <div class="text-lg font-bold text-gray-900 flex items-center gap-2">
          {{ $application->visa->destination->name_en ?? 'Destination' }}
          <span
            class="text-xs bg-orange-100 text-orange-600 px-2 py-0.5 rounded-md">{{ $application->visa->type ?? 'Visa' }}</span>
        </div>
        <div class="text-sm text-gray-500 mt-1 flex items-center gap-4">
          <span class="flex items-center gap-1"><i class="fa-regular fa-id-card"></i>
            Passport: {{ Str::mask($application->passport_number, '*', -4) }}</span>
        </div>
      </div>
    </div>
  </div>
@endforeach