<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    const PAYMENT_COMPLETED = 1;
    const PAYMENT_PENDING = 0;

    public $table = 'payments';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'order_number',
        'order_date',
        'status',
        'total'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */

}
