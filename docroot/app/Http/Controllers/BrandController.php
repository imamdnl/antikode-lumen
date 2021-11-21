<?php

namespace App\Http\Controllers;


use App\UseCase\Brand\CreateBrandUseCase;
use App\UseCase\Brand\DeleteBrandUseCase;
use App\UseCase\Brand\GetBrandsUseCase;
use App\UseCase\Brand\UpdateBrandUseCase;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    public function create(Request $request, CreateBrandUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function update(Request $request, UpdateBrandUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function delete(Request $request, DeleteBrandUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function getBrands(Request $request, GetBrandsUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }
}
