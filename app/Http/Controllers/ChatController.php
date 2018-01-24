<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Сообщение было успешно отправлено.
     */
    const MESSAGE_SENT = 'The message was sent';

    /**
     * ChatController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Стартовая страница приложения.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Получить все сообщения.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Отправить сообщение.
     *
     * @param Request $request
     * @return array
     */
    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $message = $user->messages()->create([
            'message' => $request->input('message'),
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => self::MESSAGE_SENT];
    }
}
