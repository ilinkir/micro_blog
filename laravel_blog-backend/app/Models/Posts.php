<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory;
    use SoftDeletes; //Трейт для мягкого удаления (добавляет поле deleted_at и не отображает если удалено на сайте, но в бд сохраняется)

    public $guarded = ['id']; // защита от массового заполнения полей
    public $fillable =[]; // поля доступные для массового заполнения

    protected $casts = [
        'is_relevant' => 'boolean',
    ]; //Конвертация значений, особенно удобно если нужно хранить данные в json формате, то в sql нужно создать поле text и класть туда просто массив невозможно и будет ошибка, для этого просто добавить поле и array, напр - 'options' => 'array'

    protected $dispatchesEvents = [
        'created' => \App\Events\PostCreated::class,
    ];

    public function scopeRelevant($query){
        return $query->where('is_relevant', 1);
    }

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }
}
