<?php

namespace App\UseCase\Product;

use App\Domain\Brand;
use App\Domain\Product;
use App\Domain\Repository\IBrandRepositoryMysql;
use App\Domain\Repository\IProductRepositoryMysql;
use function Symfony\Component\String\b;

class CreateProductUseCase
{
    private IProductRepositoryMysql $productRepository;
    private IBrandRepositoryMysql $brandRepository;

    public function __construct(IProductRepositoryMysql $productRepository, IBrandRepositoryMysql $brandRepository)
    {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
    }

    public function execute(array $payloads)
    {
        $brandRepo = isset($payloads['brandId']) ? $this->brandRepository->findBrandById($payloads['brandId']) : null;
        $product = Product::create($payloads);
        if ($brandRepo) {
            $brand = Brand::create((array)$brandRepo);
            $product->setBrand($brand);
        }
        $productId = $this->productRepository->addProduct($product);
        $product->setId($productId);
        return $product;
    }
}
