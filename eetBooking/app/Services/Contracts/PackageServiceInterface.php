<?php

namespace App\Services\Contracts;

interface PackageServiceInterface
{
  public function getAvailablePackages(): array;
  public function getPackageDetails(int $id): ?array;
}
