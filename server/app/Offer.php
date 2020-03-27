<?php
# @Author: Codeals
# @Date:   20-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   alejandro
# @Last modified time: 2019-11-25T02:07:04+01:00
# @Copyright: Codeals

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    /*
    |------------------------------------------------------------------------------------
    | Table
    |------------------------------------------------------------------------------------
    */
    protected $table = 'offers';

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
        'type',
        'ads',
        'date_ini',
        'date_end',
        'date_expire',
        'price_pay',
        'receive',
        'recharge_amount',
        'is_deleted'
    ];

    /**
     * @param $value
     * @return mixed
     */
    // public function getDateExpireAttribute($value)
    // {
    //     // setlocale(LC_TIME, 'es_ES');
    //     // Carbon::setLocale('es');
    //     // $date = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($value))->format('l jS \\of F Y');
    //     // return $date;
    //     // return Carbon::createFromDate($value, 'Europe/Madrid')->toDayDateTimeString();
    //     // return Carbon::parse($value)->toDayDateTimeString();
    //
    //     date_default_timezone_set('Europe/Madrid');
    //     setlocale(LC_TIME, 'es_ES');
    //     $data1 = date_create_from_format("Y-m-d", $value);
		// $data1 = date_format($data1, 'j \d\e F Y');
    //     return $data1;
    // }

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'name' => "required",
            'type' => "required",
            'price_pay' => "required",
            'recharge_amount' => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'name' => "required",
            'type' => "required",
            'price_pay' => "required",
            'recharge_amount' => "required",
        ]);
    }

    /*
    |------------------------------------------------------------------------------------
    | relations
    |------------------------------------------------------------------------------------
    */
    // 1:m
    public function recharges()
    {
        return $this->hasMany(Recharge::class);
    }
    // // 1:m
    // public function recharge()
    // {
    //     return $this->hasMany(Recharge::class);
    // }

    /*
    |------------------------------------------------------------------------------------
    | functions
    |------------------------------------------------------------------------------------
    */

}
