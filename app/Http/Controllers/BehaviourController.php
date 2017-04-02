<?php
namespace App\Http\Controllers;

use App\Models\Behaviour;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Handle requests for the Behaviour resource
 *
 * Class BehaviourController
 */
class BehaviourController extends Controller {
    /**
     * @return Collection All current Behaviour
     */
    public function index () : Collection {
        return Behaviour::all();
    }

    /**
     * Create a new Behaviour
     *
     * @param Request $request
     * @return Behaviour The newly created Behaviour
     */
    public function store (Request $request) : Behaviour {
        $this->validate($request, [
            'description'           => 'required|min:2|max:255',
            'behaviour_category_id' => 'required|exists:behaviour_category,id,deleted_at,NULL',
            'is_enabled'            => 'boolean',
        ]);

        $behaviour = Behaviour::create($request->all());

        return Behaviour::find($behaviour->id);
    }

    /**
     * Updates a Behaviour
     *
     * @param string $id The id of the Behaviour to delete
     * @param Request $request
     * @return Behaviour
     */
    public function update (string $id, Request $request) : Behaviour {
        $request['id'] = $id;
        $this->validate($request, [
            'id'                    => 'required|exists:behaviour,id,deleted_at,NULL',
            'description'           => 'min:2|max:255',
            'is_enabled'            => 'boolean',
            'behaviour_category_id' => 'exists:behaviour_category,id,deleted_at,NULL',
        ]);

        $behaviour = Behaviour::find($id);
        $behaviour->update($request->all());

        return $behaviour;
    }

    /**
     * Deletes a behaviour
     *
     * @param string $id The id of the behaviour to delete
     * @return Behaviour|Response
     */
    public function destroy (string $id) : Response {
        $this->validate( new Request([ 'id' => $id ]), [
            'id' => 'exists:behaviour,id,deleted_at,NULL'
        ]);

        Behaviour::find($id)->delete();

        return response(null, '204');
    }
}