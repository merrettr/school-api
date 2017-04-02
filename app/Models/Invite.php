<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * An invitation to a new user to sign up to the app
 * 
 * Class Invite
 * @package App\Models
 */
class Invite extends Model {
    protected $table = 'invite';
    protected $hidden = [
        'deleted_at',
    ];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'token',
    ];

    /**
     * Return valid tokens that have not expired
     *
     * @param $query
     * @return Builder
     */
    public function scopeValid ($query) : Builder {
        return $query->where('created_at', '>', Carbon::today()->subWeek(1))
            ->where('user_id', '=', null);
    }
}