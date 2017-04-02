<?php
namespace App\Http\Controllers;

use App\Models\Observation;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;

/**
 * Handle requests for Students Observations
 *
 * Class StudentObservationController
 */
class StudentObservationController extends Controller {
    /**
     * @param int $id
     * @return Collection
     */
    public function index (int $id) : Collection {
        $this->validate(new Request([ 'id' => $id ]), [
            'id' => 'required|exists:student,id',
        ]);

        return Student::find($id)
            ->observations;
    }

    /**
     * Create a new observation
     *
     * @param Request $request
     * @param Auth $auth
     * @param int $id
     * @return mixed
     */
    public function store (Request $request, Auth $auth, int $id) : Observation {
        $request['id'] = $id;
        $this->validate($request, [
            'id'            => 'required|exists:student,id',
            'behaviour_id'  => 'required|exists:behaviour,id',
        ]);

        return Student::find($id)
            ->observations()
            ->create(array_merge($request->all(), [
                'user_id' => $auth->user()->id,
            ]));
    }
}