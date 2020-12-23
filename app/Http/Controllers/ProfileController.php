<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Followship;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Helpers\Activity;


class ProfileController extends Controller
{
    protected $user;
    protected $profile;

    public function __construct(User $user, Profile $profile)
    {
        $this->user = $user;
        $this->profile = $profile;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $follower = Followship::where('followed_id', $request->user()->id)->get();
        $following = Followship::where('follower_id', $request->user()->id)->get();
        $user = $this->user->find($request->user())->first();

        return view('user.profile', compact('user','follower', 'following'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = 'edit profile';
        $target = $id;
        Activity::addActivity($type, $target);

        $profile = $this->user->findOrFail($id)->profile;

        return view('user.edit_profile', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        $profile = $user->profile;
        $imageName = $request['avatar-file'] ? $this->processImage($profile, $request['avatar-file']) : $profile->avatar;
        if (isset($request['name'])) {
            $user->name = $request['name'];
        }
        if (isset($request['gender'])) {
            $profile->gender =  $request['gender'];
        }
        $profile->avatar = $imageName;
        $user->push();
        return back()->with('success', trans('messages.front_end.profile.update_success'));
    }

    public function updatePasswordd(PasswordRequest $request)
    {
        $user = Auth::user();
        $result = $this->updatePassword($user, $request->all());   
        
        switch ($result) {
            case true:
                Auth::logout();

                return redirect()->route('login')
                        ->with('success', trans('messages.front_end.profile.update_success'));
                break;

            case false:
                return back()->with('error', trans('messages.front_end.profile.password_error_diff'));
                break;

            case null:
                return back()->with('error', trans('messages.front_end.profile.password_not_match'));
                break;

            default:
                return back()->with('error', trans('messages.front_end.profile.update_error'));
                break;
        }
    }

    public function processImage($profile, $image) {
        $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/img/user/');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $oldImage = $profile->avatar;
        if ($oldImage != public_path('/img/user/user-1.jpg')) {
            $oldPath = $path . $oldImage;
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $image->move($path, $imageName);

        return $imageName;
    }

    public function updatePassword($user, $request)
    {
        $result = true;
        $hashedPassword = $user->password;
        if (Hash::check($request['old_password'], $hashedPassword)) {
            if (!Hash::check($request['password'], $hashedPassword)) {
                $user->password = bcrypt($request['password']);
                $user->update([
                    'password' => $user->password,
                ]);
            } else {
                $result = false;
            }
        } else {
            $result = null;
        }

        return $result;
    }
}
