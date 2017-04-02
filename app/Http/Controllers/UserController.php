<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Handle requests for the Behaviour resource
 *
 * Class UserController
 */
class UserController extends Controller {
    /**
     * @param Request $request
     * @return Model The logged in user and their roles
     */
    public function get(Request $request) : Model {
        return User::with('roles')
            ->where('id', $request->user()->id)
            ->first();
    }
}