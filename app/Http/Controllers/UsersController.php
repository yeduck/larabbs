<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    //显示用户资料
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //编辑用户资料
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    //保存用户编辑
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
