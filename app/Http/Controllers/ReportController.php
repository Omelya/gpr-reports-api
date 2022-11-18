<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Http\Transformers\Report\ReportTransformer;
use App\Repositories\Involvement\InvolvementRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function get(
        ReportRequest $request,
        ReportTransformer $reportTransformer,
        InvolvementRepository $involvementRepository
    ) {
        $reportDTO = $reportTransformer->transform(
            $request->input('filter.date_from'),
            $request->input('filter.date_to')
        );
        $involvement = $involvementRepository->getAllByDate(
            $reportDTO->getDateFrom(),
            $reportDTO->getDateTo()
        );

        return $involvement;
    }
}
