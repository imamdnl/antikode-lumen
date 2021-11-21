<?php

namespace App\UseCase\Outlet;

use App\Domain\Brand;
use App\Domain\Outlet;
use App\Domain\Repository\IBrandRepositoryMysql;
use App\Domain\Repository\IOutletRepositoryMysql;

class CreateOutletUseCase
{
    private IOutletRepositoryMysql $outletRepository;
    private IBrandRepositoryMysql $brandRepository;

    public function __construct(IOutletRepositoryMysql $outletRepository, IBrandRepositoryMysql $brandRepository)
    {
        $this->outletRepository = $outletRepository;
        $this->brandRepository = $brandRepository;
    }

    public function execute(array $payloads)
    {
        $brandRepo = isset($payloads['brandId']) ? $this->brandRepository->findBrandById($payloads['brandId']) : null;
        $outlet = Outlet::create($payloads);
        if ($brandRepo) {
            $brand = Brand::create((array)$brandRepo);
            $outlet->setBrand($brand);
        }
        $outletId = $this->outletRepository->addOutlet($outlet);
        $outlet->setId($outletId);
        return $outlet;
    }
}
