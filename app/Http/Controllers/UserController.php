<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userHome(Request $request)
    {
        return view('Forms.all_forms', [
            'users' => User::all()->toArray()
        ]);
    }

    public function saveUserData(Request $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->save();

        return redirect('/user');
    }

    public function getPhoneAndVkId(Request $request, User $userId)
    {
        $data = collect($userId)
            ->only('phone', 'vk_id');
        return json_encode($data);
    }

    public function getData(User $user)
    {
        return view('user_info', [
            'userInfoCols' => $user->toArray(),
            'tests' => $user->tests()->get()->toArray(),
            'courses' => $user->courses()->get()->toArray(),
            'settings' => $user->settings()->get()->toArray()
        ]);
    }

}
