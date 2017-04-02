<?php
namespace App\Http\Controllers;

use App\Models\Observation;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Handle requests for all observations
 *
 * Class ObservationController
 */
class ObservationController extends Controller {
    public function index (Request $request) {
        return Observation::from($request->get('from', Carbon::create(1900)->toDateString()))
            ->to($request->get('to', Carbon::now()->toDateString()))
            ->get();
    }
}