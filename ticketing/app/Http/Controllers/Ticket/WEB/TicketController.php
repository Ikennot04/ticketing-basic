<?php

namespace App\Http\Controllers\Ticket\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private RegisterTickets $registerTickets;

    public function __construct(RegisterTickets $registerTickets)
    {
        $this->registerTickets = $registerTickets;
    }

     public function createTickets(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'user_id' => 'required|numeric',
            'subject' => 'required|string',
            'description' => 'required|numeric',
            'status' => 'required|numeric',
            
            
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $this->registerTickets->create(
            $this->generateUserId(),
            $data['user_id'],
            $data['subject'],
            $data['discription'],
            $data['status'],
            );

        return response()->json(['message' => 'test']);
    }
    public function generateUserId()
    {
        do {
            $user_id = $this->generateRandomAlphaNumeric(15);
        } while ($this->registerTickets->findByUserID($user_id));

        return $user_id;
    }
     public function generateRandomAlphaNumeric(int $length = 15): string
    {
        return substr(bin2hex(random_bytes($length / 2)), 0, $length);
    }

}
