<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';

    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function tests(){
        return $this->belongsToMany(Test::class);
    }

    public function questionTypes(){
        return $this->belongsToMany(QuestionType::class);
    }
}
