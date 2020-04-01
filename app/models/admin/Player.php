<?php

namespace App\models\admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Player extends Authenticatable
{
    use Notifiable;

    protected $guard = 'player';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
    ];

}
