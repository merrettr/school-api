<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A student reconciliation process
 *
 * Class Reconcile
 * @package App\Models
 */
class Reconcile extends Model {
    protected $table = 'reconcile';
    protected $hidden = [
        'file_path',
    ];
    protected $fillable = [
        'file_name',
        'file_path',
        'created',
        'updated',
        'deleted',
        'was_success',
        'error',
    ];
}