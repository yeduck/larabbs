<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

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
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $arrData = $request->all();
        if ($request->avatar) {
            $arrResult = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if ($arrResult) {
                $arrData['avatar'] = $arrResult['path'];
            }
        }
        $user->update($arrData);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
