<?php

namespace App\Services;

use App\Services\Contracts\PackageServiceInterface;
use App\Repositories\Contracts\BaseRepositoryInterface;

class PackageService implements PackageServiceInterface
{
  protected BaseRepositoryInterface $packageRepository;

  public function __construct(BaseRepositoryInterface $packageRepository)
  {
    $this->packageRepository = $packageRepository;
  }

  public function getAvailablePackages(): array
  {
    // Business logic for filtering/sorting available packages
    return $this->packageRepository->all()->toArray();
  }

  public function getPackageDetails(int $id): ?array
  {
    $package = $this->packageRepository->find($id);
    return $package ? $package->toArray() : null;
  }
}
