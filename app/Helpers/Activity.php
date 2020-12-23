<?php
namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Activity {
    public static function addActivity(string $type, string $target)
    {
        Auth::user()->activities()->create([
            'acvity_type' => $type,
            'descrition' => $target,
        ]);
    }
}

