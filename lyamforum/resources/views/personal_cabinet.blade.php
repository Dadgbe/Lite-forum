<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Добавим небольшие стили для улучшения внешнего вида */
        .card {
            height: 100%; /* Это поможет выровнять блоки по высоте */
        }
        .my-3 {
            margin-bottom: 1rem !important; /* Это добавит отступ между блоками */
        }
    </style>
</head>
<body>
    @include('partials.header')

    <div class="container mt-5">
        <h1>Личный кабинет</h1>
        <div class="row align-items-stretch">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">Информация о профиле</h2>
                        <p class="card-text">Имя: {{ $user->name }}</p>
                        <p class="card-text">Email: {{ $user->email }}</p>
                        <!-- Другие данные профиля -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Действия</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{ route('profile.edit') }}" class="card-link">Редактировать профиль</a></li>
                            <li class="list-group-item"><a href="{{ route('topic.create') }}" class="card-link">Создать тему для обсуждения</a></li>
                            <!-- Другие действия -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Созданные темы</h2>
                        <ul class="list-group list-group-flush">
                            @foreach($user->topics as $topic)
                                <li class="list-group-item"><a href="{{ route('topic.show', $topic->id) }}" class="card-link">{{ $topic->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
