<?php

// В вашем ForumController.php
namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {

        $topics = Topic::all(); // Получаем список всех тем

        // Проверяем, есть ли темы для обсуждения
        if ($topics->isEmpty()) {
            $noTopicsMessage = 'Тем для обсуждения еще нет.';
            return view('forum', compact('noTopicsMessage'));
        }

        return view('forum', compact('topics'));
    }
}
