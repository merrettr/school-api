<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A role a user can have in the app
 * 
 * Class Role
 * @package App\Models
 */
class Role extends Model {
    protected $table = 'role';
    protected $hidden = [
        'pivot',
        'deleted_at',
    ];
    protected $fillable = [
        'description',
    ];
}