<?php

namespace App\UseCase\Brand;

use App\Domain\Brand;
use App\Domain\Repository\IBrandRepositoryMysql;

class GetBrandsUseCase
{
    private IBrandRepositoryMysql $brandRepository;

    public function __construct(IBrandRepositoryMysql $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function execute(array $payloads)
    {
        $brands = $this->brandRepository->findBrands($payloads, $payloads);
        $countData = $this->brandRepository->countBrands($payloads);
        return [
            array_map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'logo' => $data->logo,
                    'banner' => $data->banner,
                    'createdAt' => $data->createdAt,
                    'updatedAt' => $data->updatedAt,
                ];
            }, $brands),
            'count' => $countData,
            'page' => $payloads['page'] ?? 1,
            'limit' => $payloads['limit'] ?? 10,
        ];
    }
}
