<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{

    protected static $unguarded = [
        'id',
        'created_at',
        'updated_At',
    ];

}
