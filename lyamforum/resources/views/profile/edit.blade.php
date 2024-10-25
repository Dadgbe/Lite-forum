<!-- resources/views/profile/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .space-top {
            margin-top: 20px;
        }
    </style>
    <title>Редактирование профиля</title>
</head>
<body>
    @include('partials.header')

    <div class="container">
        <div class="space-top"></div> <!-- Добавляем пустой блок для отступа -->
        <h1>Редактирование профиля</h1>
        <!-- Форма для редактирования данных пользователя -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <!-- Поле для имени -->
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
            </div>
            <!-- Поле для адреса электронной почты -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
            <!-- Поле для пароля -->
            <div class="form-group">
                <label for="password">Новый пароль:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <!-- Поле для подтверждения пароля -->
            <div class="form-group">
                <label for="password_confirmation">Подтверждение пароля:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>
            <!-- Кнопка сохранения изменений -->
            <button type="submit" class="btn btn-primary">Сохранение изменений</button>
        </form>
    </div>
</body>
</html>
