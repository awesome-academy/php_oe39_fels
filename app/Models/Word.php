<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = [
        'text',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_word', 'word_id', 'user_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'word_id', 'id');
    }
}
