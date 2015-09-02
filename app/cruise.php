<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cruise extends Model
{
    protected $table = 'cruises';
    public $timestamps = false;
    public $primaryKey = 'cruise_id';
}
