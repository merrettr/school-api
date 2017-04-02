<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A category which can contain behaviours
 * 
 * Class Behaviour
 * @package App\Models
 */
class BehaviourCategory extends Model {
    use SoftDeletes;

    protected $table = 'behaviour_category';
    protected $hidden = [
        'deleted_at',
    ];
    protected $fillable = [
        'description',
        'is_enabled',
    ];

    function getIsEnabledAttribute($isEnabled) : bool {
        return $isEnabled == 1;
    }
}