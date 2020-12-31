<?php

namespace App\Repositories\User\Profile;

interface ProfileRepositoryInterface {
    public function displayProfile($id);
    public function processImage($profile, $image);
    public function updateProfile($user, $request);
    public function updatePassword($user, $request);

}
