<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PrivateMessage;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function sendMessage(Request $request)
    {
        // Logic to send the message

        $message = $request->input('message');
        $userId = $request->input('user_id');

        event(new PrivateMessage($message, $userId));
    }
}
