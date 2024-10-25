<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'content' => 'required',
            'topic_id' => 'required|exists:topics,id'
        ]);

        // Проверяем, был ли дан ответ на комментарий
        $replyToUserId = null;
        if ($request->has('parent_id')) {
            $parentMessage = Message::find($request->parent_id);
            if ($parentMessage) {
                $replyToUserId = $parentMessage->user_id;
            }
        }

        // Создание нового сообщения с учетом ответа на комментарий
        Message::create([
            'user_id' => auth()->id(), // Предполагается, что пользователь авторизован
            'topic_id' => $request->topic_id,
            'content' => $request->content,
            'reply_to_user_id' => $replyToUserId // Устанавливаем id пользователя, на которого дан ответ
        ]);

        return back()->with('success', 'Сообщение добавлено успешно!');
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required|string', // Проверка данных
        ]);

        // Обновление содержимого сообщения
        $message->update([
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Сообщение успешно обновлено');
    }

    public function destroy(Message $message)
    {
        // Delete the message
        $message->delete();

        // Redirect back or return a response as needed
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
