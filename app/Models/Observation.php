<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * An observation of a students behaviour from a staff member
 *
 * Class Observation
 * @package App\Models
 */
class Observation extends Model {
    use SoftDeletes;

    protected $table = 'observation';
    protected $hidden = [
        'deleted_at',
    ];
    protected $fillable = [
        'user_id',
        'behaviour_id',
        'student_id',
        'notes',
    ];

    public function scopeFrom(Builder $query, string $from) : Builder {
        return $query->where('created_at', '>=', $from);
    }

    public function scopeTo(Builder $query, string $to) : Builder {
        $date = Carbon::createFromFormat('Y-m-d', $to);
        $date->setTime(23, 59, 59);
        return $query->where('created_at', '<=', $date->toDateTimeString());
    }
}