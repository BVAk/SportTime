<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "visiting";
    protected $fillable = [
        'user_id', 'date'
    ];

}
