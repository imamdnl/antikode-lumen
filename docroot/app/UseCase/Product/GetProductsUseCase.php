<?php

namespace App\UseCase\Product;

use App\Domain\Repository\IProductRepositoryMysql;

class GetProductsUseCase
{
    private IProductRepositoryMysql $productRepository;

    public function __construct(IProductRepositoryMysql $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(array $payloads)
    {
        $products = $this->productRepository->findProducts($payloads, $payloads);
        $countData = $this->productRepository->countProducts($payloads);
        return [
            array_map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'picture' => $data->picture,
                    'price' => $data->price,
                    'brand' => $data->brand,
                    'createdAt' => $data->createdAt,
                    'updatedAt' => $data->updatedAt,
                ];
            }, $products),
            'count' => $countData,
            'page' => $payloads['page'] ?? 1,
            'limit' => $payloads['limit'] ?? 10,
        ];
    }
}
