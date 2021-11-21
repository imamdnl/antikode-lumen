<?php

namespace App\Domain\Repository;

use App\Domain\Brand;

interface IBrandRepositoryMysql
{
    /**
     * @param Brand $brand
     * @return int
     */
    public function addBrand(Brand $brand): int;

    /**
     * @param Brand $brand
     * @return bool
     */
    public function updateBrand(Brand $brand): bool;

    /**
     * @param Brand $brand
     * @return bool
     */
    public function deleteBrand(Brand $brand): bool;

    /**
     * @param int $id
     * @return Brand|null
     */
    public function findBrandById(int $id): ?Brand;

    /**
     * @param array $by
     * @param array $options
     * @return array
     */
    public function findBrands(array $by = [], array $options = []): array;

    /**
     * @param array $by
     * @return int
     */
    public function countBrands(array $by = []): int;
}
