<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stateroom extends Model
{
    protected $table = 'stateroom';
    public $timestamps = false;
    public $primaryKey = 'stateroom_id';
}
