<?php
# @Author: Codeals
# @Date:   26-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 26-11-2019
# @Copyright: Codeals

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /*
    |------------------------------------------------------------------------------------
    | Table
    |------------------------------------------------------------------------------------
    */
    protected $table = 'payments';

    /*
    |------------------------------------------------------------------------------------
    | Primary Key
    |------------------------------------------------------------------------------------
    */
    protected $primaryKey = 'id';

    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
    protected $fillable = [
        'id',
        'recharge_id',
        'user_id',
        'token',
        'amount',
        'method',
        'paypal_payment_id',
        'is_payment'
    ];

    protected $appends = ['recharge', 'user'];

    /**
     * @param $value
     * @return mixed
     */

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------------------------------
    | relations
    |------------------------------------------------------------------------------------
    */
    // m:1
    public function recharge()
    {
        return $this->belongsTo(Recharge::class);
    }

    // m:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |------------------------------------------------------------------------------------
    | functions
    |------------------------------------------------------------------------------------
    */
    public function getUserAttribute()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function getRechargeAttribute()
    {
        return Recharge::where('id', $this->recharge_id)->first();
    }
}
