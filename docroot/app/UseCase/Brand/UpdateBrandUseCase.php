<?php

namespace App\UseCase\Brand;

use App\Domain\Brand;
use App\Domain\Repository\IBrandRepositoryMysql;

class UpdateBrandUseCase
{
    private IBrandRepositoryMysql $brandRepository;

    public function __construct(IBrandRepositoryMysql $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function execute(array $payloads)
    {
        $brand = Brand::create($payloads);
        return $this->brandRepository->updateBrand($brand);
    }
}
