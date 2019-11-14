<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class PrivateTraining extends Model
{
    //Переменные для вывода данных из БД
    protected $table = "privateschedule";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'trainer_id','training_id', 'user_id','date','endtrain','checked'
        ];
}