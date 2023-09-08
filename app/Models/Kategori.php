<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'id_kategori';

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

    public function apendidikan(){
        return $this->hasMany(Apendidikan::class, 'id_kategori','id_kategori');
    }
}
