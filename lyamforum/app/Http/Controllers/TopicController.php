<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Message;


class TopicController extends Controller
{

    public function index()
    {
        $topics = Topic::all(); // Получаем все темы из базы данных
        return view('topics.index', ['topics' => $topics]); // Отображаем список тем
    }

    public function create()
    {
        return view('topics.create'); // Отображаем форму для создания темы
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $topic = new Topic();
        $topic->user_id = auth()->id();
        $topic->title = $request->input('title');
        $topic->save();

        // Перенаправление на личный кабинет
        return redirect()->route('personal_cabinet')->with('success', 'Тема успешно создана');
    }

    public function show($id)
    {
        // Найдем тему
        $topic = Topic::findOrFail($id);

        // Получим сообщения для этой темы
        $messages = Message::where('topic_id', $id)->get();

        // Передадим найденную тему и сообщения в представление
        return view('topics.show', compact('topic', 'messages'));
    }

    public function edit(Topic $topic)
    {
        return view('topics.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $topic->update($request->all());

        return redirect()->route('forum.index')->with('success', 'Тема успешно обновлена.');
    }

     public function destroy(Topic $topic)
    {
        // Удаляем все сообщения, связанные с этой темой
        Message::where('topic_id', $topic->id)->delete();

        // Затем удаляем саму тему
        $topic->delete();

        return redirect()->route('forum.index')->with('success', 'Тема успешно удалена.');
    }


}
