<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

/**
 * A staff member
 *
 * Class User
 * @package App\Models
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract {
    use Authenticatable, Authorizable, HasApiTokens, SoftDeletes;

    protected $table = 'users';
    protected $hidden = [
        'password',
        'deleted_at',
    ];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public function findForPassport (string $email) : User {
        return User::where('email', $email)
            ->first();
    }

    public function roles () : BelongsToMany {
        return $this->belongsToMany('App\Models\Role', 'user_role')
            ->withTimestamps();
    }

    public function hasRole (string $role) : bool {
        foreach ($this->roles as $r) {
            if ($r->description == $role) {
                return true;
            }
        }

        return false;
    }
}
