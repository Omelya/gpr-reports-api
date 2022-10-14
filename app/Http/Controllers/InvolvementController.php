<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvolvementRequest;
use App\Http\Transformers\Involvement\InvolvementTransformer;
use App\Repositories\Involvement\InvolvementRepository;
use App\Http\Resources\InvolvementResource;

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
}
