<?php

namespace App\Http\Controllers;

use App\UseCase\Product\CreateProductUseCase;
use App\UseCase\Product\DeleteProductUseCase;
use App\UseCase\Product\GetProductsUseCase;
use App\UseCase\Product\UpdateProductUseCase;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function create(Request $request, CreateProductUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function update(Request $request, UpdateProductUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function delete(Request $request, DeleteProductUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function getProducts(Request $request, GetProductsUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }
}
