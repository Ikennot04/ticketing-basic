<?php

namespace App\Http\Controllers\Ticket\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Application\Ticket\RegisterTickets;
use App\Domain\Ticket\Ticket;
use App\Domain\Ticket\TicketRepository;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    private RegisterTickets $registerTickets;

    public function __construct(RegisterTickets $registerTickets)
    {
        $this->registerTickets = $registerTickets;
    }
    public function findAll()
    {
        try {
            $ticketModels = $this->registerTickets->findAll();
            if (empty($ticketModels)) {
                return response()->json(['tickets' => []], 200);
            }

            $tickets = array_map(function ($ticket) {
                return [
                    'user_id' => $ticket->getUser_id(),
                    'subject' => $ticket->getSubject(),
                    'description' => $ticket->getDescription(),
                    'status' => $ticket->getStatus(),
                    
                ];
            }, $ticketModels);

            return response()->json(['tickets' => $tickets], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching tickets',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

     public function createTickets(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'user_id' => 'required|numeric',
            'subject' => 'required|string',
            'description' => 'required|string', // <-- should be string
            'status' => 'required|string',      // <-- should be string
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $this->registerTickets->create(
            $data['user_id'],                // user_id as int
            $this->generateTicketId(),       // ticket_id as string
            $data['subject'],
            $data['description'],
            $data['status'],
        );

        return response()->json(['message' => 'Ticket created']);
    }
    public function generateUserId()
    {
        do {
            $user_id = $this->generateRandomAlphaNumeric(15);
        } while ($this->registerTickets->findByTicketID($user_id));

        return $puser_id;
    }
    public function generateTicketId(): string
    {
        return $this->generateRandomAlphaNumeric(15);
    }
     public function generateRandomAlphaNumeric(int $length = 15): string
    {
        return substr(bin2hex(random_bytes($length / 2)), 0, $length);
    }
    public function updateTicket(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'subject' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }
        $data = $request->all();

        $existingTicket = $this->registerTickets->findByUserID($data['user_id']);
        if (! $existingTicket) {
            return response()->json(['message' => 'Ticket Not Found!', 'user_id' => $data['user_id']], 404);
        }
        $this->registerTickets->update(
            $data['user_id'],
            $data['subject'],
            $data['description'],
            $data['status'],
            
        );

        return response()->json(true, 200);
    }

    public function destroy($id)
    {
        try {
            $userId = auth()->id();
            $tickets = $this->registerTickets->findAll();
            $ticket = collect($tickets)->first(function ($ticket) use ($id) {
                return $ticket->getId() == $id;
            });

            if (! $ticket) {
                return response()->json(['message' => 'Ticket not found'], 404);
            }

            if ($ticket->getUserID() !== $user_idd) {
                return response()->json(['message' => 'Unauthorized to delete this product'], 403);
            }

            $this->registerTickets->delete($ticket->getTicket_id());

            return response()->json([
                'message' => 'Ticket archived successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error archiving product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        try {
            $tickets = DB::table('ticekt')
                ->whereNull('deleted_at')
                ->get();

            return response()->json([
                'success' => true,
                'tickets' => $tickets,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
