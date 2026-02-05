<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PackageMedia;
use App\Models\Destination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DownloadImagesSeeder extends Seeder
{
  public function run()
  {
    $this->command->info('Downloading placeholder images to local storage...');

    // 1. Process Package Media
    $medias = PackageMedia::all();
    foreach ($medias as $media) {
      if (Str::startsWith($media->url, 'http')) {
        $this->command->info("Downloading package image: {$media->url}");
        $localPath = $this->downloadImage($media->url, 'packages');

        if ($localPath) {
          $media->update(['url' => $localPath]);
        }
      }
    }

    // 2. Process Destinations (if they use simple array of strings)
    $destinations = Destination::all();
    foreach ($destinations as $dest) {
      $images = $dest->images;
      if (is_array($images)) {
        $newImages = [];
        $changed = false;

        foreach ($images as $img) {
          if (Str::startsWith($img, 'http')) {
            $this->command->info("Downloading destination image: {$img}");
            $localPath = $this->downloadImage($img, 'destinations');
            if ($localPath) {
              $newImages[] = $localPath;
              $changed = true;
            } else {
              $newImages[] = $img;
            }
          } else {
            $newImages[] = $img;
          }
        }

        if ($changed) {
          $dest->update(['images' => $newImages]);
        }
      }
    }

    $this->command->info('All images processed!');
  }

  private function downloadImage($url, $folder)
  {
    try {
      $contents = Http::get($url)->body();
      $name = Str::random(40) . '.jpg';
      $path = "$folder/$name";
      Storage::disk('public')->put($path, $contents);
      return $path;
    } catch (\Exception $e) {
      $this->command->error("Failed to download: $url");
      return null;
    }
  }
}
