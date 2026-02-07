<?php

$legacyFile = 'd:/Z-programs/eetbooking-rebuild/full_packages_export.csv';
$newFile = 'd:/Z-programs/eetbooking-rebuild/eetBooking/storage/app/imports/2.csv';

$locationMap = [
  'Riyadh' => 'Riyadh',
  'Jeddah' => 'Jeddah',
  'Abha' => 'Abha',
  'Dahab' => 'Dahab',
  'Aswan' => 'Aswan',
  'Luxor' => 'Luxor',
  'Hurghada' => 'Hurghada',
  'Sharm El Sheikh' => 'Sharm El Sheikh',
  'Marsa Alam' => 'Marsa Alam',
  'Taba' => 'Taba',
  'Giza' => 'Giza',
  'Cairo' => 'Cairo',
  'El Gouna' => 'El Gouna',
  'Red Sea' => 'Hurghada',
  'Dubai' => 'Dubai',
  'Istanbul' => 'Istanbul',
  'Bursa' => 'Bursa',
  'Cappadocia' => 'Cappadocia',
  'Baku' => 'Baku',
  'Silk Way' => 'Baku',
  'Tbilisi' => 'Tbilisi',
  'Yerevan' => 'Yerevan',
  'Muscat' => 'Muscat',
  'London' => 'London',
  'Italy' => 'Rome',
  'Italian' => 'Rome',
  'the Eternal City' => 'Rome',
  'Rome' => 'Rome',
  'Venice' => 'Venice',
  'Florence' => 'Florence',
  'Amsterdam' => 'Amsterdam',
  'Benelux' => 'Amsterdam',
  'Brussels' => 'Brussels',
  'Luxembourg' => 'Luxembourg',
  'Phuket' => 'Phuket',
  'Zanzibar' => 'Zanzibar',
  'Maldives' => 'Malé',
  'Kuala Lumpur' => 'Kuala Lumpur',
  'Langkawi' => 'Langkawi',
  'Malaysia' => 'Kuala Lumpur',
  'Cyprus' => 'Larnaca'
];

function getDest($title, $map)
{
  foreach ($map as $k => $v) {
    if (stripos($title, $k) !== false) return $v;
  }
  return 'Unknown';
}

function cleanCSVText($str)
{
  if (empty($str)) return '';
  // Remove all types of newlines and tabs to keep the CSV row on one line
  $str = str_replace(["\r", "\n", "\t"], " ", $str);
  // Remove extra spaces
  $str = preg_replace('/\s+/', ' ', $str);
  return trim($str);
}

function parseInclusions($str)
{
  if (empty($str)) return '';
  // If it's the weird escaped JSON from the legacy file
  $data = json_decode($str, true);
  if (!$data || !is_array($data)) {
    return cleanCSVText($str);
  }
  return implode(', ', array_map('cleanCSVText', $data));
}

$handle = fopen($legacyFile, 'r');
if (!$handle) die("Could not open legacy file: $legacyFile\n");

$headers = fgetcsv($handle);

$output = fopen($newFile, 'w');
// Write Header matching PackageImport exactly
fputcsv($output, [
  'title_en',
  'title_ar',
  'short_description_en',
  'short_description_ar',
  'full_description_en',
  'full_description_ar',
  'price',
  'original_price',
  'discount',
  'duration_nights',
  'type',
  'destination_name_en',
  'min_people',
  'max_people',
  'distance_from_center_km',
  'difficulty_level',
  'best_season',
  'is_featured_10',
  'is_offer_10',
  'offer_tag',
  'is_popular_10',
  'rating',
  'is_active_10',
  'inclusions_en_comma_separated',
  'inclusions_ar_comma_separated',
  'exclusions_en_comma_separated',
  'exclusions_ar_comma_separated'
]);

// Write Guidance Row
fputcsv($output, array_fill(0, 27, 'MANDATORY'));

while (($row = fgetcsv($handle)) !== false) {
  if (empty($row[0])) continue;

  $title = cleanCSVText($row[0]);
  $dest = getDest($title, $locationMap);

  fputcsv($output, [
    $title,
    $title,
    '',
    '',
    cleanCSVText($row[2] ?? ''), // Full Description
    '',
    trim($row[3] ?? 0), // Price
    trim($row[4] ?? null), // Original Price
    '',
    trim($row[5] ?? 1), // Duration
    trim($row[6] ?: 'General'), // Type
    $dest,
    1,       // Min People
    '',      // Max People
    '',      // Distance
    '',      // Difficulty
    '',      // Best Season
    (stripos($row[9] ?? '', 'yes') !== false ? 1 : 0), // Featured
    0,
    '',
    0,
    (is_numeric($row[7] ?? null) ? $row[7] : 5), // Rating
    1,  // Active
    parseInclusions($row[11] ?? ''), // Inclusions
    '', // Inclusions AR
    '', // Exclusions EN
    ''  // Exclusions AR
  ]);
}

fclose($handle);
fclose($output);
echo "Conversion Complete: $newFile\n";
