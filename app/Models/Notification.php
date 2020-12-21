<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notification
 * @package App\Models
 * @version May 3, 2020, 11:58 am UTC
 *
 * @property string message
 * @property string url
 * @property integer user_id
 */
class Notification extends Model
{
    use SoftDeletes;

    public $table = 'notifications';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'message',
        'url',
        'user_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'url' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'message' => 'required',
        'user_id' => 'required'
    ];


}
