<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvolvementRequest;
use App\Http\Resources\InvolvementsResource;
use App\Http\Transformers\Involvement\InvolvementTransformer;
use App\Repositories\Involvement\InvolvementRepository;
use App\Http\Resources\InvolvementResource;
use App\Http\Resources\AllInvolvementResource;
use Illuminate\Http\Request;

class InvolvementController extends Controller
{
    public function create(
        InvolvementRequest $involvementRequest,
        InvolvementTransformer $involvementTransformer,
        InvolvementRepository $involvementRepository
    ) {
        $involvementDTO = $involvementTransformer->transform($involvementRequest);
        $involvement = $involvementRepository->create($involvementDTO);

        return new InvolvementResource($involvement);
    }

    public function getAll(
        Request $request,
        InvolvementRepository $involvementRepository
    ) {
        $involvement = $involvementRepository->getAll(
            $request->input('filter.order') ?? 'date_notification',
            $request->input('filter.direction') ?? 'asc'
        );

        return new AllInvolvementResource($involvement);
    }

    public function remove(
        string $involvementId,
        InvolvementRepository $involvementRepository
    )
    {
        $involvementRepository->remove($involvementId);

        return response()->noContent();
    }

    public function edit(
        string $id,
        InvolvementRequest $involvementRequest,
        InvolvementTransformer $involvementTransformer,
        InvolvementRepository $involvementRepository
    ) {
        $involvementDTO = $involvementTransformer->transform($involvementRequest);
        $involvement = $involvementRepository->edit($involvementDTO, $id);

        return new InvolvementResource($involvement);
    }

    public function get(
        string $id,
        InvolvementRepository $involvementRepository
    ) {
        $involvement = $involvementRepository->getById($id);

        return new InvolvementsResource($involvement);
    }
}
