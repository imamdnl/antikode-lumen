<?php

namespace App\Adapters\Gateways\Database\Mysql\Mapper;

use App\Adapters\Gateways\Database\Mysql\Model\OutletModel;
use App\Domain\Outlet;
use Carbon\Carbon;

class OutletMapper
{
    /**
     * @param OutletModel $model
     * @return Outlet
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function toDomainEntity(OutletModel $model): Outlet
    {
        $brand = null;
        if( $model->brand ){
            $brand = BrandMapper::toDomainEntity($model->brand);
        }
        $outlet = Outlet::create($model->toArray());
        return $outlet->setBrand($brand);
    }

    /**
     * @param $outletModels
     * @return Outlet[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function toDomainEntities($outletModels): array
    {
        $outlets = [];
        foreach ($outletModels as $domainEntity) {
            $outlets[] = self::toDomainEntity($domainEntity);
        }
        return $outlets;
    }

    /**
     * @param Outlet $outlet
     * @return array
     */
    public static function toEloquentEntity(Outlet $outlet): array
    {
        return [
            'brandId' => $outlet->getBrand() ? $outlet->getBrand()->id : null,
            'name' => $outlet->name,
            'picture' => $outlet->picture,
            'address' => $outlet->address,
            'latitude' => $outlet->latitude,
            'longitude' => $outlet->longitude,
            'createdAt' => $outlet->createdAt ?? Carbon::now()->toDateTimeString(),
            'updatedAt' => $outlet->updatedAt ?? Carbon::now()->toDateTimeString(),
        ];
    }
}
