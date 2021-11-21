<?php

namespace App\UseCase\Product;

use App\Domain\Product;
use App\Domain\Repository\IProductRepositoryMysql;

class DeleteProductUseCase
{
    private IProductRepositoryMysql $productRepository;

    public function __construct(IProductRepositoryMysql $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(array $payloads)
    {
        $productRepo = $this->productRepository->findProductById($payloads['id']);
        if (!$productRepo) {
            throw new \Exception('Product not found', 404);
        }
        $product = Product::create((array)$productRepo);
        return $this->productRepository->deleteProduct($product);
    }
}
