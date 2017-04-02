<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * Handle requests tokens
 *
 * Class AuthController
 */
class AuthController extends Controller {
    public function store (Request $request) {
        $user = User::where('email', $request->get('email'))->first();

        if ($user && Hash::check($request->get('password'), $user->password)) {
            return $user->createToken($user->id);
        }

        return Response::create(['error' => 'Unauthorized', 'code' => 401], 401);
    }
}