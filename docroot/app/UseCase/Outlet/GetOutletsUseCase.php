<?php

namespace App\UseCase\Outlet;

use App\Domain\Repository\IOutletRepositoryMysql;

class GetOutletsUseCase
{
    private IOutletRepositoryMysql $outletRepository;

    public function __construct(IOutletRepositoryMysql $outletRepository)
    {
        $this->outletRepository = $outletRepository;
    }

    public function execute(array $payloads)
    {
        $outlets = $this->outletRepository->findOutlets($payloads, $payloads);
        $countData = $this->outletRepository->countOutlets($payloads);
        return [
            array_map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'picture' => $data->picture,
                    'address' => $data->address,
                    'longitude' => $data->longitude,
                    'latitude' => $data->latitude,
                    'brand' => $data->brand,
                    'createdAt' => $data->createdAt,
                    'updatedAt' => $data->updatedAt,
                ];
            }, $outlets),
            'count' => $countData,
            'page' => $payloads['page'] ?? 1,
            'limit' => $payloads['limit'] ?? 10,
        ];
    }
}
