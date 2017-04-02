<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A type of behaviour a student can exhibit
 * 
 * Class Behaviour
 * @package App\Models
 */
class Behaviour extends Model {
    use SoftDeletes;

    protected $table = 'behaviour';
    protected $hidden = [
        'deleted_at',
    ];
    protected $fillable = [
        'description',
        'behaviour_category_id',
        'is_enabled',
    ];

    function getIsEnabledAttribute($isEnabled) {
        return $isEnabled == 1;
    }
}