<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
