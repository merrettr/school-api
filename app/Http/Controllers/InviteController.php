<?php
namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Handle requests for inviting new users
 *
 * Class InviteController
 */
class InviteController extends Controller {
    /**
     * @return Collection The last 10 unaccepted invites
     */
    public function index () : Collection {
        return Invite::where('user_id', '=', null)
            ->valid()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * Get a single invite from a token
     *
     * @param string $token
     * @return Response
     */
    public function get (string $token) : Response {
        $invite = Invite::where('token', '=', $token)
            ->valid()
            ->first();

        // check the token is valid
        if (!$invite) {
            return response([
                'code' => 400,
                'message' => 'Invalid invite',
            ], 400);
        }

        return response($invite, 200);
    }

    /**
     * Invite a new user
     *
     * @param Request $request
     * @return Response The newly created invite
     */
    public function store (Request $request) : Response {
        $this->validate($request, [
            'first_name'    => 'required|min:2|max:255',
            'last_name'     => 'required|min:2|max:255',
            'email'         => 'required|email',
        ]);

        // TODO move into custom validation rule for store and update to use
        $existingInvite = Invite::where('email', $request->email)
            ->valid()
            ->first();

        $existingUser = User::where('email', $request->email)
            ->first();

        if ($existingInvite || $existingUser) {
            return response([
                'code' => 400,
                'message' => 'Email already invited',
            ], 400);
        }

        $invite = Invite::create(array_merge(
            $request->all(),
            [
                'token' => hash_hmac('sha256', uniqid(bin2hex(random_bytes(32))), env('app_key')),
            ]
        ));

        //TODO use markdown emailer
        $link = env('INVITE_REDIRECT');
        $link = str_replace('?1', $invite->email, $link);
        $link = str_replace('?2', $invite->token, $link);

        $message =
"You have been invited to the School App

Please follow this link to sign up:
$link";

        Mail::raw($message, function ($msg) use ($request) {
            $msg->to($request->email);
        });

        return response($invite, 200);
    }

    /**
     * Accept an invitation
     *
     * @param Request $request
     * @param string $token
     * @return Response
     */
    public function update (Request $request, string $token) : Response {
        $request['token'] = $token;
        $this->validate($request, [
            'password' => 'required|min:4|max:255',
            'token' => 'required|exists:invite,token,user_id,NULL'
        ]);

        $invite = Invite::where('token', '=', $token)
            ->valid()
            ->first();

        // check the token hasn't expired
        if (!$invite) {
            return response([
                'code' => 400,
                'message' => 'Invalid invite',
            ], 400);
        }

        $user = User::create(array_merge($invite->toArray(), [
            'password' => Hash::make($request->password),
        ]));

        $invite->user_id = $user->id;
        $invite->save();

        return response($invite, 200);
    }
}