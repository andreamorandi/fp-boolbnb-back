<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'lead_first_name' => ['required', 'max:50'],
            'lead_last_name' => ['required', 'max:50'],
            'lead_email' => ['required', 'email', 'max:100'],
            'text' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $new_message = new Message();
        $new_message->fill($data);
        // dd($new_message);
        $new_message->save();

        // Mail::to('admin@boolbnb.com')->send(new NewContact($new_message));

        return response()->json([
            'success' => true
        ]);
    }
}
