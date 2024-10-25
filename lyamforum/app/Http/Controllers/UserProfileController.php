<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Убедитесь, что подключили модель пользователя

class UserProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id); // Получаем пользователя по ID
        return view('user.profile', ['user' => $user]);
    }
}
