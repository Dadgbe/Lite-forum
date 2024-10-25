<!-- resources/views/topics/edit.blade.php -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать тему</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white">
    @include('partials.header')

    <div class="container py-4">
        <h1>Редактировать тему</h1>
        <form action="{{ route('topic.update', $topic->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $topic->title }}">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить тему</button>
        </form>

        <form action="{{ route('topic.destroy', $topic->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">Удалить тему</button>
        </form>
    </div>
</body>
</html>
