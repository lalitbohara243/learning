<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version February 26, 2020, 6:33 am UTC
 *
 * @property string name
 * @property string slug
 */
class OrderDetail extends Model
{
    use SoftDeletes;

    public $table = 'order_details';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total',
        'status'
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
