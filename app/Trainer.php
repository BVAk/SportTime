<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'birth', 'start', 'phone', 'image'
    ];

    /**
     * The trainings that belong to the trainer.
     */
    public function trainings()
    {
        return $this->belongsToMany('App\Training', 'traintrain');
    }
}
