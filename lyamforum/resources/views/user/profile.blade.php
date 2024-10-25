<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .profile-container {
            max-width: 600px;
            margin: auto;
        }
        .profile-heading {
            margin-bottom: 20px;
        }
        .profile-topics {
            list-style-type: none;
            padding: 0;
        }
        .profile-topic-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    @include('partials.header')
    <div class="profile-container">
        <h1 class="profile-heading">Профиль пользователя</h1>
        <p>Имя пользователя: {{ $user->name }}</p>
        <p>Количество созданных тем: {{ $user->topics()->count() }}</p>
        <h2>Список тем пользователя</h2>
        <ul class="profile-topics">
            @foreach ($user->topics as $topic)
                <li class="profile-topic-item"><a href="{{ route('topic.show', $topic->id) }}">{{ $topic->title }}</a></li>
            @endforeach
        </ul>
    </div>
</body>
</html>
