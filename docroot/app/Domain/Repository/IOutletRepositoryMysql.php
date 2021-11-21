<?php

namespace App\Domain\Repository;

use App\Domain\Outlet;

interface IOutletRepositoryMysql
{
    /**
     * @param Outlet $outlet
     * @return int
     */
    public function addOutlet(Outlet $outlet): int;

    /**
     * @param Outlet $outlet
     * @return bool
     */
    public function updateOutlet(Outlet $outlet): bool;

    /**
     * @param Outlet $outlet
     * @return bool
     */
    public function deleteOutlet(Outlet $outlet): bool;

    /**
     * @param int $id
     * @return Outlet|null
     */
    public function findOutletById(int $id): ?Outlet;

    /**
     * @param array $by
     * @param array $options
     * @return array
     */
    public function findOutlets(array $by = [], array $options = []): array;

    /**
     * @param array $by
     * @return int
     */
    public function countOutlets(array $by = []): int;
}
