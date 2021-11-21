<?php

namespace App\UseCase\Outlet;

use App\Domain\Outlet;
use App\Domain\Repository\IOutletRepositoryMysql;

class DeleteOutletUseCase
{
    private IOutletRepositoryMysql $outletRepository;

    public function __construct(IOutletRepositoryMysql $outletRepository)
    {
        $this->outletRepository = $outletRepository;
    }

    public function execute(array $payloads)
    {
        $outletRepo = $this->outletRepository->findOutletById($payloads['id']);
        if (!$outletRepo) {
            throw new \Exception('Outlet not found', 404);
        }
        $outlet = Outlet::create((array)$outletRepo);
        return $this->outletRepository->deleteOutlet($outlet);
    }
}
