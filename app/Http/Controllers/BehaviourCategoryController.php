<?php
namespace App\Http\Controllers;

use App\Models\BehaviourCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Handle requests for the BehaviourCategory resource
 *
 * Class BehaviourCategoryController
 */
class BehaviourCategoryController extends Controller {
    /**
     * @return Collection All current BehaviourCategory
     */
    public function index () : Collection {
        return BehaviourCategory::all();
    }

    /**
     * Create a new BehaviourCategory
     *
     * @param Request $request
     * @return BehaviourCategory The newly created BehaviourCategory
     */
    public function store (Request $request) : BehaviourCategory {
        $this->validate($request, [
            'description' => 'required|min:2|max:255',
            'is_enabled' => 'boolean',
        ]);

        $category = BehaviourCategory::create($request->all());

        return BehaviourCategory::find($category->id);
    }

    /**
     * Updates a BehaviourCategory
     *
     * @param string $id The id of the BehaviourCategory to update
     * @param Request $request
     * @return BehaviourCategory
     */
    public function update (string $id, Request $request) : BehaviourCategory {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:behaviour_category,id,deleted_at,NULL',
            'description' => 'min:2|max:255',
            'is_enabled' => 'boolean',
        ]);

        $category = BehaviourCategory::find($id);
        $category->update($request->all());

        return $category;
    }

    /**
     * Deletes a BehaviourCategory
     *
     * @param string $id The id of the behaviour to delete
     * @return Response
     */
    public function destroy (string $id) : Response {
        $this->validate(new Request(['id' => $id]), [
            'id' => 'exists:behaviour_category,id,deleted_at,NULL'
        ]);

        BehaviourCategory::find($id)->delete();

        return response(null, '204');
    }
}