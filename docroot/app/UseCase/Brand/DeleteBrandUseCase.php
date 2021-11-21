<?php

namespace App\UseCase\Brand;

use App\Domain\Brand;
use App\Domain\Repository\IBrandRepositoryMysql;

class DeleteBrandUseCase
{
    private IBrandRepositoryMysql $brandRepository;

    public function __construct(IBrandRepositoryMysql $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function execute(array $payloads)
    {
        $brandRepo = $this->brandRepository->findBrandById($payloads['id']);
        if (!$brandRepo) {
            throw new \Exception('Brand not found', 404);
        }
        $brand = Brand::create((array)$brandRepo);
        return $this->brandRepository->deleteBrand($brand);
    }
}
