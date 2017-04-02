<?php
namespace App\Http\Controllers;

use App\Jobs\ReconcileJob;
use App\Models\Reconcile;
use App\Models\Student;
use App\Services\StudentReconciliation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Handle requests for the Student resource
 *
 * Class StudentController
 */
class StudentController extends Controller {
    /**
     * Search for students
     * @param Request $request
     * @return Collection of Students
     */
    public function index (Request $request) : Collection {
        return Student::where('first_name', 'like', $request->get('search', '') . '%')
            ->orWhere('last_name', 'like', $request->get('search', '') . '%')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();
    }

    /**
     * Take in a CSV file of students and send it to a queue to be processed
     *
     * @param Request $request
     * @return Response
     */
    public function reconcile (Request $request) : Response {
        $this->validate($request, [
           'students' => 'mimetypes:text/csv,text/plain'
        ]);

        $file = $request->file('students');
        $dir = env('FILE_PATH');
        $name = $file->getClientOriginalName() . '.' . time();

        $file->move($dir, $name);

        $reconcile = Reconcile::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $dir . '/' . $name,
        ]);

        return response(
            StudentReconciliation::reconcile($reconcile),
            200
        );
    }
}