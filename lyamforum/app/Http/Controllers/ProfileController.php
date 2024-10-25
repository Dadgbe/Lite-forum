<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        // Получаем текущего аутентифицированного пользователя
        $user = Auth::user();
        // Возвращаем представление для редактирования профиля с передачей пользователя в представление
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // Получаем текущего аутентифицированного пользователя
        $user = Auth::user();

        // Валидация данных из запроса
        $request->validate([
            'name' => 'required|string|max:255',
            // Другие правила валидации для других полей профиля
        ]);

        // Обновляем данные профиля
        $user->name = $request->name;
        // Обновляем другие поля профиля, если есть

        // Сохраняем обновленные данные
        $user->save();

        // Перенаправляем пользователя на страницу редактирования профиля с сообщением об успешном обновлении
        return redirect()->route('profile.edit')->with('success', 'Профиль успешно обновлен.');
    }
}
