<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akesehatan extends Model
{
    use HasFactory;
    protected $table = 'akesehatan';
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'id_arkes';

    protected static function boot(){
        parent::boot();
        static::creating(function ($model){
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function getIncrementing(){
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
