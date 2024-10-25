<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $topic->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-bottom: 80px; /* Добавляем отступ внизу для размещения кнопки отправки */
        }
        .fixed-bottom {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 20px;
            border-top: 1px solid #dee2e6;
            z-index: 1000; /* Устанавливаем высокий z-index, чтобы кнопка была поверх других элементов */
        }
        .comment-container {
            margin-bottom: 20px; /* Добавляем отступ между комментариями */
        }

        .spacer {
            height: 251.39px; /* Высота равна высоте вашей фиксированной формы */
        }
    </style>
</head>
<body class="bg-white">
@include('partials.header')

<div class="container py-4">
    <h1>{{ $topic->title }}</h1>
    <p>Автор: <a href="{{ route('user.profile', $topic->user->id) }}">{{ $topic->user->name }}</a></p>
    <p>Дата создания: {{ $topic->created_at }}</p>

    @auth
        @if(auth()->user()->isAdmin || auth()->user()->id === $topic->user_id)
            <p><a href="{{ route('topic.edit', $topic->id) }}">Редактировать</a></p>
        @endif
    @endauth

    <h2>Комментарии:</h2>
    @if ($messages->isEmpty())
        <p>К этой теме пока нет сообщений.</p>
    @else
        @foreach ($messages as $message)
            <div class="comment-container" data-message-id="{{ $message->id }}">
                <div class="card mb-3">
                    <div class="card-body">
                        @if ($message->reply_to_user_id && $message->replyToUser)
                            <h5 class="card-title">
                                Автор: <a href="{{ route('user.profile', $message->user->id) }}">{{ $message->user->name }}</a>
                                пользователю <a href="{{ route('user.profile', $message->replyToUser->id) }}">{{ $message->replyToUser->name }}</a>
                            </h5>
                        @else
                            <h5 class="card-title">
                                Автор: <a href="{{ route('user.profile', $message->user->id) }}">{{ $message->user->name }}</a>
                            </h5>
                        @endif
                        <h6 class="card-subtitle mb-2 text-muted">Дата создания: {{ $message->created_at }}</h6>
                        <p class="card-text comment-content">{{ $message->content }}</p>
                        @auth
                            @if(auth()->user()->isAdmin || auth()->user()->id === $message->user_id)
                                <a href="#" class="btn btn-sm btn-primary edit-comment" data-message-id="{{ $message->id }}">Редактировать</a>
                                <form action="{{ route('message.destroy', ['message' => $message->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-comment">Удалить</button>
                                </form>
                            @endif
                        @endauth
                        <a href="#" class="btn btn-sm btn-primary reply-link" data-user="{{ $message->user->name }}" data-message-id="{{ $message->id }}">Ответить</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>


<div class="spacer"></div>

<div class="fixed-bottom">
    <div class="container">
        @auth
            <div class="message-form">
                <h2 id="message-title">Отправить комментарий</h2>
                <form id="message-form" action="{{ route('message.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                    <input type="hidden" name="parent_id" value="">
                    <div class="mb-3">
                        <textarea class="form-control" name="content" placeholder="Введите ваше сообщение..." rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a href="#" class="btn btn-secondary cancel-reply" style="display: none;">Отмена</a>
                </form>
            </div>
        @else
            <p>Для отправки сообщения необходимо <a href="{{ route('login') }}">авторизоваться</a>.</p>
        @endauth
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Event listener for reply links
        document.querySelectorAll('.reply-link').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                let userName = event.target.dataset.user;
                let messageId = event.target.dataset.messageId;
                let userProfileUrl = "{{ route('user.profile', $message->user->id) }}"; // You need to add data-user-id in the reply link data attributes

                // Update form heading
                document.getElementById('message-title').innerHTML = `Отправить комментарий пользователю <a href="${userProfileUrl}">${userName}</a>`;

                // Update form action to include the message ID
                let form = document.getElementById('message-form');
                form.action = "{{ route('message.store') }}"; // Update your route accordingly

                // Add hidden input to form for parent message ID
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'parent_id';
                hiddenInput.value = messageId;
                form.appendChild(hiddenInput);

                // Show cancel button
                document.querySelector('.cancel-reply').style.display = 'inline-block';

                // Scroll to the form
                form.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Cancel reply button
        document.querySelector('.cancel-reply').addEventListener('click', event => {
            event.preventDefault();

            // Reset form heading
            document.getElementById('message-title').innerHTML = 'Отправить комментарий';

            // Reset form action
            let form = document.getElementById('message-form');
            form.action = "{{ route('message.store') }}"; // Reset to the default store route

            // Remove hidden input
            form.querySelector('input[name="parent_id"]').remove();

            // Hide cancel button
            event.target.style.display = 'none';
        });

        // Event listener for edit comment buttons
        document.querySelectorAll('.edit-comment').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                let commentContainer = event.target.closest('.comment-container');
                let commentContent = commentContainer.querySelector('.comment-content');
                let messageId = commentContainer.getAttribute('data-message-id');
                let editFormHtml = `
                    <form class="edit-form" action="{{ route('message.update', ['message' => ':messageId']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <textarea class="form-control" name="content" rows="4">${commentContent.textContent.trim()}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                `;
                // Replace comment content with edit form
                commentContent.innerHTML = editFormHtml.replace(':messageId', messageId);
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Event listener for delete comment buttons
        document.querySelectorAll('.delete-comment').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                let confirmation = confirm('Вы уверены, что хотите удалить этот комментарий?');
                if (confirmation) {
                    // Если пользователь подтвердил удаление, продолжите с отправкой формы
                    event.target.closest('form').submit();
                }
            });
        });
    });
</script>

</body>
</html>
