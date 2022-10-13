<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvolvementRequest;
use App\Http\Transformers\Involvement\InvolvementTransformer;

class InvolvementController extends Controller
{
    public function create(
        InvolvementRequest $involvementRequest,
        InvolvementTransformer $involvementTransformer
    )
    {
        return $involvementTransformer->transform($involvementRequest)->getActCode();
    }
}
