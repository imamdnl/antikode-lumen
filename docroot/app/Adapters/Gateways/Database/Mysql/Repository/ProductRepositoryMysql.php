<?php

namespace App\Adapters\Gateways\Database\Mysql\Repository;

use App\Adapters\Gateways\Database\Mysql\Mapper\ProductMapper;
use App\Adapters\Gateways\Database\Mysql\Model\ProductModel;
use App\Domain\Product;
use App\Domain\Repository\IProductRepositoryMysql;
use Carbon\Carbon;

class ProductRepositoryMysql implements IProductRepositoryMysql
{
    public function addProduct(Product $product): int
    {
        $dataInsert = ProductMapper::toEloquentEntity($product);
        $insertId = ProductModel::insertGetId($dataInsert);
        $product->setId($insertId);
        return $insertId;
    }

    public function updateProduct(Product $product): bool
    {
        $product->setUpdatedAt(Carbon::now()->toDateTimeString());
        $productUpdate = ProductMapper::toEloquentEntity($product);
        return ProductModel::findOrFail($product->id)->update($productUpdate);
    }

    public function deleteProduct(Product $product): bool
    {
        return ProductModel::findOrFail($product->id)->delete();
    }

    public function findProductById(int $id): ?Product
    {
        $data = ProductModel::where('id', $id)->first();
        if (!$data) {
            return null;
        }
        return ProductMapper::toDomainEntity($data);
    }

    public function findProducts(array $by = [], array $options = []): array
    {
        $query = ProductModel::query();
        $optionOrderBy = $options['orderBy'] ?? null;
        $options['orderBy'] = $optionOrderBy ?? ProductModel::CREATED_AT;
        $jobs = $this->_extendQuery($query, $by, $options)->get();
        return ProductMapper::toDomainEntities($jobs);
    }

    /**
     * @param array $by
     * @return int
     */
    public function countProducts(array $by = []): int
    {
        $query = ProductModel::query();
        return $this->_extendQuery($query, $by)->count();
    }

    protected function _extendQuery($query, $by = [], $options = [])
    {
        $q = $by['q'] ?? null;
        $id = $by['id'] ?? null;
        $limit = $options['limit'] ?? 10;
        $page = $options['page'] ?? 1;
        $sort = $options['sort'] ?? false;
        $orderBy = $options['orderBy'] ?? null;

        if ($q) {
            $query->where('name', 'like', "%$q%");
        }
        if ($id) {
            $query->where('id', $id);
        }
        if($orderBy){
            $query->orderBy($orderBy, boolval($sort) ? 'desc' : 'asc');
        }
        if( $limit ) {
            $query->forPage($page, $limit);
        }
        return $query;
    }
}
