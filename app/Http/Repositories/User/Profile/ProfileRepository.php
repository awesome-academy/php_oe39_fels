<?php

namespace App\Repositories\User\Profile;
use App\Repositories\BaseRepository;
use App\Repositories\User\Profile\ProfileRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface {

    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function displayProfile($id)
    {
        return $this->model::with('profile')->get()->find($id);
    }

    public function processImage($profile, $image)
    {
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

    public function updateProfile($user, $request)
    {
        $profile=$user->profile;
        if (isset($request['avatar-file'])) {
            $imageName = $this->processImage($profile, $request['avatar-file']);
        } else {
            $imageName = $profile->avatar;
        }
        if (isset($request['name'])) {
            $user->name = $request['name'];
        }
        if (isset($request['gender'])) {
            $profile->gender =  $request['gender'];
        }
        $profile->avatar = $imageName;
        $user->push();
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

    public function resultExamUser($id)
    {
        $user = Auth::user();
        $result = User::find($user->id)->lessons()->where('user_id', $user->id)
                ->where('lesson_id', $id)->first();
        return $result;
    }

    public function wordStatusUser()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return $user->words;
    }
}
