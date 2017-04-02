<?php
namespace App\Http\Controllers;
use App\Services\ReportService;
use Illuminate\Http\Response;

/**
 * Handle requests for report data
 *
 * Class ReportController
 */
class ReportController extends Controller {
    /**
     * @var ReportService ReportService
     */
    private $reportService;
    
    function __construct(ReportService $reportService) {
        $this->reportService = $reportService;
    }

    public function index (string $type) : Response {
        switch ($type) {
            case 'student':
                return Response::create($this->reportService->getStudentReport());
            case 'behaviour':
            case 'behavior':
                return Response::create($this->reportService->getBehaviourReport());
            case 'teacher':
                return Response::create($this->reportService->getTeacherReport());
            default:
                return abort(404);
        }
    }
}