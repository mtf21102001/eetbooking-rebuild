<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\PackageImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class ImportPackages extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'packages:import {filename : The name of the excel/csv file in storage/app/imports/}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Import packages from an excel/csv file directly via CLI';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $filename = $this->argument('filename');
    $directory = storage_path('app/imports');
    $path = $directory . '/' . $filename;

    if (!File::exists($path)) {
      $this->error("\n[!] File not found at: {$path}");
      $this->info("Make sure the file is placed in storage/app/imports/\n");
      return 1;
    }

    $this->info("\n========================================");
    $this->info("🚀 Starting Import: {$filename}");
    $this->info("========================================\n");

    // Choose Import Class based on file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $isLegacy = ($extension === 'txt' || stripos($filename, 'full') !== false);

    $import = $isLegacy ? new \App\Imports\LegacyPackageImport : new \App\Imports\PackageImport;

    if ($isLegacy) {
      $this->warn("Detected Legacy/Full Export format. Using Smart Location Detection...\n");
    }

    try {
      Excel::import($import, $path);

      $this->info("\n========================================");
      $this->info("✅ Import Finished!");
      $this->info("----------------------------------------");
      $this->info("Successfully Imported: " . $import->successful);
      $this->warn("Skipped / Failed:     " . $import->skipped);

      if (!empty($import->errors)) {
        $this->error("\nDetailed Errors / Rejections:");
        foreach ($import->errors as $error) {
          $this->line(" - {$error}");
        }
      }
      $this->info("========================================\n");
    } catch (\Exception $e) {
      $this->error("\n[!] Fatal Error: " . $e->getMessage() . "\n");
      return 1;
    }

    return 0;
  }
}
