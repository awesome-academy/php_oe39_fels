<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Repositories\User\Profile\ProfileRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileRepo;

    public function __construct(ProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepo=$profileRepo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->profileRepo->displayProfile($id);

        return view('user.edit_profile',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        $user=Auth::user();
        $this->profileRepo->updateProfile($user,$request->all());

        return redirect()->back()->with('success', trans('messages.front_end.profile.update_success'));
    }

    public function updatePasswordd(PasswordRequest $request)
    {
        $user = Auth::user();
        $result = $this->profileRepo->updatePassword($user, $request->except('_token'));
        
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

}
