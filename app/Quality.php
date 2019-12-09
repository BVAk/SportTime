<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    protected $table="quality";
    protected $fillable = [
        'user_id','place', 'organization','cost','assortment','hygiene','material','quality_lesson'
        ];
}
