<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Http\Transformers\Report\ReportTransformer;
use App\Repositories\Involvement\InvolvementRepository;
use App\Services\Report\ReportServices;
use Exception;

class ReportController extends Controller
{
    /**
     * @throws Exception
     */
    public function get(
        ReportRequest $request,
        ReportTransformer $reportTransformer,
        InvolvementRepository $involvementRepository,
        ReportServices $reportServices
    ): array {
        $reportDTO = $reportTransformer->transform(
            $request->input('filter.date_from'),
            $request->input('filter.date_to'),
            $request->input('filter.reports_type')
        );
        $involvements = $involvementRepository->getAllByDate(
            $reportDTO->getDateFrom(),
            $reportDTO->getDateTo()
        );

        return $reportServices->setInvolvements($involvements)->getReports($reportDTO->getReportsType());
    }
}
