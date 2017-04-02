<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A student
 * 
 * Class Student
 * @package App\Models
 */
class Student extends Model {
    use SoftDeletes;

    protected $table = 'student';
    protected $hidden = [
        'deleted_at',
    ];
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'reconcile_id',
    ];

    public function observations () {
        return $this->hasMany('App\Models\Observation');
    }
}