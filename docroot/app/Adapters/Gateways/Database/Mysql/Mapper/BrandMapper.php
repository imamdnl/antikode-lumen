<?php

namespace App\Adapters\Gateways\Database\Mysql\Mapper;

use App\Adapters\Gateways\Database\Mysql\Model\BrandModel;
use App\Domain\Brand;
use Carbon\Carbon;

class BrandMapper
{
    /**
     * @param BrandModel $model
     * @return Brand
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function toDomainEntity(BrandModel $model): Brand
    {
        return Brand::create($model->toArray());
    }

    /**
     * @param $brandModels
     * @return Brand[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function toDomainEntities($brandModels): array
    {
        $brands = [];
        foreach ($brandModels as $domainEntity) {
            $brands[] = self::toDomainEntity($domainEntity);
        }
        return $brands;
    }

    /**
     * @param Brand $brand
     * @return array
     */
    public static function toEloquentEntity(Brand $brand): array
    {
        return [
            'name' => $brand->name,
            'logo' => $brand->logo,
            'banner' => $brand->banner,
            'createdAt' => $brand->createdAt ?? Carbon::now()->toDateTimeString(),
            'updatedAt' => $brand->updatedAt ?? Carbon::now()->toDateTimeString(),
        ];
    }
}
