<?php

namespace App\Adapters\Gateways\Database\Mysql\Repository;

use App\Adapters\Gateways\Database\Mysql\Mapper\BrandMapper;
use App\Adapters\Gateways\Database\Mysql\Model\BrandModel;
use App\Domain\Brand;
use App\Domain\Repository\IBrandRepositoryMysql;
use Carbon\Carbon;

class BrandRepositoryMysql implements IBrandRepositoryMysql
{
    public function addBrand(Brand $brand): int
    {
        $insertId = BrandModel::insertGetId(BrandMapper::toEloquentEntity($brand));
        $brand->setId($insertId);
        return $insertId;
    }

    public function updateBrand(Brand $brand): bool
    {
        $brand->setUpdatedAt(Carbon::now()->toDateTimeString());
        $brandUpdate = BrandMapper::toEloquentEntity($brand);
        return BrandModel::findOrFail($brand->id)->update($brandUpdate);
    }

    public function deleteBrand(Brand $brand): bool
    {
        return BrandModel::findOrFail($brand->id)->delete();
    }

    public function findBrandById(int $id): ?Brand
    {
        $data = BrandModel::where('id', $id)->first();
        if (!$data) {
            return null;
        }
        return BrandMapper::toDomainEntity($data);
    }

    public function findBrands(array $by = [], array $options = []): array
    {
        $query = BrandModel::query();
        $optionOrderBy = $options['orderBy'] ?? null;
        $options['orderBy'] = $optionOrderBy ?? BrandModel::CREATED_AT;
        $jobs = $this->_extendQuery($query, $by, $options)->get();
        return BrandMapper::toDomainEntities($jobs);
    }

    /**
     * @param array $by
     * @return int
     */
    public function countBrands(array $by = []): int
    {
        $query = BrandModel::query();
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
