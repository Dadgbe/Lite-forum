<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Форум</title>
    <style>
        .themes-content {
            width: 1290px;
            height: 1000px;
            margin: 20px auto 0;
            padding: 40px;
        }
        .themes-title h1 {
            font-size: 20px;
            margin: 2px;
            text-align: center;
        }
        .theme-link {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
            text-decoration: none;
            color: black;
            background-color: #f0f0f0; /* фоновый цвет */
            padding: 10px; /* отступы вокруг текста */
            border-radius: 5px; /* закругление углов */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); /* тень */
        }
        .theme-link:hover {
            color: blue;
        }
    </style>
</head>
<body>
    @include('partials.header')

    <div class="themes-content">
        <div class="themes-title">
            <h1>Темы для обсуждения:</h1>
        </div>
        <div class="theme-list">
            @isset($topics)
                @foreach($topics as $topic)
                    <a href="{{ route('topic.show', $topic->id) }}" class="theme-link">{{ $topic->title }}</a>
                @endforeach
            @else
                <p>{{ $noTopicsMessage }}</p>
            @endisset
        </div>
    </div>
</body>
</html>
