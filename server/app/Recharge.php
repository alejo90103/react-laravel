<?php
# @Author: Codeals
# @Date:   20-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 26-11-2019
# @Copyright: Codeals

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    /*
      |------------------------------------------------------------------------------------
      | Table
      |------------------------------------------------------------------------------------
      */
      protected $table = 'recharges';

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
          'type',
          'offer_id',
          'date_recharge',
          'user_id',
          'price_pay',
          'recharge_amount',
          'status',
          'is_deleted'
      ];

      protected $appends = ['offer', 'user'];

      /*
      |------------------------------------------------------------------------------------
      | Validations
      |------------------------------------------------------------------------------------
      */
      public static function rules($update = false, $id = null)
      {
          $commun = [
              'type' => "required",
              'date_recharge' => "required",
              'price_pay' => "required",
              'recharge_amount' => "required",
          ];

          if ($update) {
              return $commun;
          }

          return array_merge($commun, [
              'type' => "required",
              'date_recharge' => "required",
              'price_pay' => "required",
              'recharge_amount' => "required",
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
      public function offer()
      {
          return $this->belongsTo(Offer::class);
      }

      // 1:m
      public function contact_recharges()
      {
          return $this->hasMany(ContactRecharge::class);
      }

      // 1:m
      public function payments()
      {
          return $this->hasMany(Paymant::class);
      }

      // n:m
      public function contacts(){
          return $this->belongsToMany(Contact::class);
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

      public function getOfferAttribute()
      {
          return Offer::where('id', $this->offer_id)->first();
      }
  }
