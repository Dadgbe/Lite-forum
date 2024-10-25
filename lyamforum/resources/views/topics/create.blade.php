<!-- resources/views/topics/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать тему</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Создать тему для обсуждения</h1>
        <form method="POST" action="{{ route('topic.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</body>
</html>
