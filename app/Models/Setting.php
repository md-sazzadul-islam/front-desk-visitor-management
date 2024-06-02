<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Setting extends Model
{

    public $fillable = [
        'app_name',
        'app_title',
        'address',
        'phone',
        'app_email',
        'app_logo',
        'app_fav',
        'is_ad_login'
    ];
}
