<?php
# @Author: Codeals
# @Date:   19-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 21-11-2019
# @Copyright: Codeals

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'token', 'expire_at'];
}
