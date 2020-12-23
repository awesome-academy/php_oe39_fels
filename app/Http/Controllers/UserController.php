<?php

namespace App\Http\Controllers;

use App\Models\Followship;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Activity;

class UserController extends Controller
{
    public function profile($id)
    {
        $follower = Followship::where('followed_id', $id)->get();
        $following = Followship::where('follower_id', $id)->get();
        $user = User::where('id',$id)->first();

        return view('user.profile')->with(compact('user','follower','following'));
    }

    public function allUser()
    {
        $users = User::get();

        return view('user.list_user')->with(compact('users'));
    }

    public function follow($id)
    {
        $type = 'follow';
        $target = $id;
        Activity::addActivity($type, $target);

        DB::table('followships')->insert(['follower_id'=>Auth::user()->id,'followed_id'=>$id]);
        
        return back();
    }

    public function unfollow($id)
    {
        $type = 'unfollow';
        $target = $id;
        Activity::addActivity($type, $target);

        DB::table('followships')->where(['follower_id'=>Auth::user()->id,'followed_id'=>$id])->delete();
        
        return back();
    }

    public function activity()
    {
        $activities = DB::table('activities')->where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();

        return view('user.activity')->with(compact('activities'));
    }
}
