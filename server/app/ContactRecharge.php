<?php
# @Author: Codeals
# @Date:   20-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 21-11-2019
# @Copyright: Codeals

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactRecharge extends Model
{
    /*
    |------------------------------------------------------------------------------------
    | Table
    |------------------------------------------------------------------------------------
    */
    protected $table = 'contact_recharges';

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
        'message',
        'contact_id',
        'email',
        'phone',
        'is_deleted'
    ];

    protected $appends = ['recharge', 'user', 'contact'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'recharge_id' => "required",
            'user_id' => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'recharge_id' => "required",
            'user_id' => "required",
        ]);
    }

    /*
    |------------------------------------------------------------------------------------
    | relations
    |------------------------------------------------------------------------------------
    */
    // m:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // m:1
    public function recharge()
    {
        return $this->belongsTo(Recharge::class);
    }

    // m:1
    public function contact()
    {
        return $this->belongsTo(Contact::class);
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

    public function getContactAttribute()
    {
        return Contact::where('id', $this->contact_id)->first();
    }
}
