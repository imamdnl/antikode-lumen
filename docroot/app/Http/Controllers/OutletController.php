<?php

namespace App\Http\Controllers;

use App\UseCase\Outlet\CreateOutletUseCase;
use App\UseCase\Outlet\DeleteOutletUseCase;
use App\UseCase\Outlet\GetOutletsUseCase;
use App\UseCase\Outlet\UpdateOutletUseCase;
use Illuminate\Http\Request;

class OutletController extends BaseController
{
    public function create(Request $request, CreateOutletUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function update(Request $request, UpdateOutletUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function delete(Request $request, DeleteOutletUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }

    public function getOutlets(Request $request, GetOutletsUseCase $useCase)
    {
        return $this->response(200, $useCase->execute($request->toArray()));
    }
}
