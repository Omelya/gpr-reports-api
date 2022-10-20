<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvolvementRequest;
use App\Http\Transformers\Involvement\InvolvementTransformer;
use App\Repositories\Involvement\InvolvementRepository;
use App\Http\Resources\InvolvementResource;
use App\Http\Resources\AllInvolvementResource;

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

    public function getAllInvolvement(
        InvolvementRepository $involvementRepository
    ) {
        $involvement = $involvementRepository->getAllInvolvement();

        return new AllInvolvementResource($involvement);
    }
}
