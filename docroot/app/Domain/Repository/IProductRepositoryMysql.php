<?php

namespace App\Domain\Repository;

use App\Domain\Product;

interface IProductRepositoryMysql
{
    /**
     * @param Product $outlet
     * @return int
     */
    public function addProduct(Product $outlet): int;

    /**
     * @param Product $outlet
     * @return bool
     */
    public function updateProduct(Product $outlet): bool;

    /**
     * @param Product $outlet
     * @return bool
     */
    public function deleteProduct(Product $outlet): bool;

    /**
     * @param int $id
     * @return Product|null
     */
    public function findProductById(int $id): ?Product;

    /**
     * @param array $by
     * @param array $options
     * @return array
     */
    public function findProducts(array $by = [], array $options = []): array;

    /**
     * @param array $by
     * @return int
     */
    public function countProducts(array $by = []): int;
}
