<?php

namespace App\Adapters\Gateways\Database\Mysql\Mapper;

use App\Adapters\Gateways\Database\Mysql\Model\ProductModel;
use App\Domain\Product;
use Carbon\Carbon;

class ProductMapper
{
    /**
     * @param ProductModel $model
     * @return Product
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function toDomainEntity(ProductModel $model): Product
    {
        $brand = null;
        if( $model->brand ){
            $brand = BrandMapper::toDomainEntity($model->brand);
        }
        $product = Product::create($model->toArray());
        return $product->setBrand($brand);
    }

    /**
     * @param $productModels
     * @return Product[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function toDomainEntities($productModels): array
    {
        $products = [];
        foreach ($productModels as $domainEntity) {
            $products[] = self::toDomainEntity($domainEntity);
        }
        return $products;
    }

    /**
     * @param Product $product
     * @return array
     */
    public static function toEloquentEntity(Product $product): array
    {
        return [
            'brandId' => $product->getBrand() ? $product->getBrand()->id : null,
            'name' => $product->name,
            'picture' => $product->picture,
            'price' => $product->price,
            'createdAt' => $product->createdAt ?? Carbon::now()->toDateTimeString(),
            'updatedAt' => $product->updatedAt ?? Carbon::now()->toDateTimeString(),
        ];
    }
}
