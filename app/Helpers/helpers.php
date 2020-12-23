<?php

use App\Models\Followship;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

    function isFollowing($id)
    {
        if (Followship::where('followed_id', $id)->where('follower_id', auth()->user()->id)->exists()) {
            return 'following';
        }else{
            return 'follow';
        }
    }

    function isLearned($word_id)
    {
        if(DB::table('users_word')->where('user_id',auth()->user()->id)->where('word_id',$word_id)->exists()){
            return 'learned';
        }else{
            return 'unlearned';
        }
    }

    function isTypeActivity($type)
    {
        if ($type = 'follow' || $type = 'unfollow') {
            return 'user';
        }elseif ($type = 'start Lesson') {
            return 'lesson';
        }elseif ($type = 'start course') {
            return 'course';
        }
    }
    
    
