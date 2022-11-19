<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Http\Transformers\Report\ReportTransformer;
use App\Repositories\Involvement\InvolvementRepository;
use App\Services\Report\ReportServices;

class ReportController extends Controller
{
    public function get(
        ReportRequest $request,
        ReportTransformer $reportTransformer,
        InvolvementRepository $involvementRepository,
        ReportServices $reportServices
    ) {
        $reportDTO = $reportTransformer->transform(
            $request->input('filter.date_from'),
            $request->input('filter.date_to')
        );
        $involvements = $involvementRepository->getAllByDate(
            $reportDTO->getDateFrom(),
            $reportDTO->getDateTo()
        );

        return $reportServices->setInvolvements($involvements)->createReportByPromptResponse();
    }
}
