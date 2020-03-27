<?php
# @Author: Codeals
# @Date:   20-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 21-11-2019
# @Copyright: Codeals

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  /*
    |------------------------------------------------------------------------------------
    | Table
    |------------------------------------------------------------------------------------
    */
    protected $table = 'contacts';

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
        'name',
        'email',
        'phone',
        'user_id',
        'is_deleted'
    ];

    protected $appends = ['user'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'name'      => "required",
            'phone'      => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'name'      => "required",
            'phone'      => "required",
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

    // 1:m
    public function contact_recharges()
    {
        return $this->hasMany(ContactRecharge::class);
    }

    // m:n
    public function recharges(){
        return $this->belongsToMany(Recharge::class);
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
}
