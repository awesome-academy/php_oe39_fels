<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    protected $fillable = [
        'name',
        'course_id',
    ];

    protected $appends = [
        'is_complete',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_user' ,'lesson_id' ,'user_id')->withPivot('score', 'status');
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id' ,'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'lesson_id', 'id');
    }

    public function getIsCompleteAttribute()
    {
        $user = Auth::user();
        $lessonId = $this->id;
        $is_complete = User::where('id',$user->id)
            ->whereHas('lessons',function($q) use ($lessonId){
                $q->where('lessons.id', $lessonId);
            })
            ->exists();

        return $is_complete;
    }
}
