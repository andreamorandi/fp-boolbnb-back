<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;


class MessageController extends Controller
{
    public function index()
    {
        $messages = DB::table('messages as m')
            ->join('apartments as a', 'm.apartment_id', '=', 'a.id')
            ->join('users as u', 'a.user_id', '=', 'u.id')
            ->select('m.*')
            ->where('u.id', '=', Auth::id())
            ->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::where('id', $id)->first();
        return view('admin.messages.show', compact('message'));
    }
}
