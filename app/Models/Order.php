<?php

namespace App\Models;

use App\User;
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
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';


    protected $dates = ['deleted_at','order_date'];



    public $fillable = [
       'user_id',
        'order_number',
        'order_date',
        'status',
        'total',
        'shipping_id'
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
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
