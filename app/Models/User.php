<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Word;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_user','user_id', 'course_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user', 'user_id', 'lesson_id');
    }

    public function words()
    {
        return $this->belongsToMany(Word::class, 'users_word', 'user_id', 'word_id')->withPivot('status');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class,'user_id','id');
    }
}
