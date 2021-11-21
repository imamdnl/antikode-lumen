<?php

namespace App\Adapters\Gateways\Database\Mysql\Repository;

use App\Adapters\Gateways\Database\Mysql\Mapper\OutletMapper;
use App\Adapters\Gateways\Database\Mysql\Model\OutletModel;
use App\Domain\Outlet;
use App\Domain\Repository\IOutletRepositoryMysql;
use Carbon\Carbon;

class OutletRepositoryMysql implements IOutletRepositoryMysql
{
    public function addOutlet(Outlet $outlet): int
    {
        $dataInsert = OutletMapper::toEloquentEntity($outlet);
        $insertId = OutletModel::insertGetId($dataInsert);
        $outlet->setId($insertId);
        return $insertId;
    }

    public function updateOutlet(Outlet $outlet): bool
    {
        $outlet->setUpdatedAt(Carbon::now()->toDateTimeString());
        $outletUpdate = OutletMapper::toEloquentEntity($outlet);
        return OutletModel::findOrFail($outlet->id)->update($outletUpdate);
    }

    public function deleteOutlet(Outlet $outlet): bool
    {
        return OutletModel::findOrFail($outlet->id)->delete();
    }

    public function findOutletById(int $id): ?Outlet
    {
        $data = OutletModel::where('id', $id)->first();
        if (!$data) {
            return null;
        }
        return OutletMapper::toDomainEntity($data);
    }

    public function findOutlets(array $by = [], array $options = []): array
    {
        $query = OutletModel::query();
        $optionOrderBy = $options['orderBy'] ?? null;
        $options['orderBy'] = $optionOrderBy ?? OutletModel::CREATED_AT;
        $jobs = $this->_extendQuery($query, $by, $options)->get();
        return OutletMapper::toDomainEntities($jobs);
    }

    /**
     * @param array $by
     * @return int
     */
    public function countOutlets(array $by = []): int
    {
        $query = OutletModel::query();
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
