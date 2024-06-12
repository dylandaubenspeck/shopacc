<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\TicketsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function handleCreateTicket(Request $request)
    {
        try {
            $ticket = new Tickets();
            $ticket->userId = Auth::id();
            $ticket->status = 0;
            $ticket->title = $request->input('title');
            $ticket->productId = $request->input('productId') ?? null;
            $ticket->save();

            $ticketMessage = new TicketsMessage();
            $ticketMessage->ticketId = $ticket->id;
            $ticketMessage->userId = Auth::id();
            $ticketMessage->message = $request->input('message');
            if ($request->hasFile('img'))
            {
                $image      = $request->file('img');
                $image_name = time() . '.' . $image->extension();
                $image->move(public_path('ticketsImg'), $image_name);
                $ticketMessage->attachments = $image_name;
            }
            $ticketMessage->save();

            return redirect()->route('ticket.view', ['id' => $ticket->id]);
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' | ' . __FUNCTION__ . ' | ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function getTicketContent($id, $latestId)
    {
        try {
            if (TicketsMessage::where('ticketId', $id)->count() > 0)
            {
                $ticketContent = TicketsMessage::where([
                    ['ticketId', $id],
                    ['id', '>', $latestId],
                    ['userId', NULL]
                ])->orderBy('created_at', 'desc')->get();
                return response()->json([
                    'status' => 1,
                    'data' => $ticketContent
                ]);
            }else
            {
                return response()->json([
                    'status' => 0,
                    'data' => 'not_found'
                ]);
            }
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' | ' . __FUNCTION__ . ' | ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function sendMessage(Request $request, $id)
    {
        try {
            if (Tickets::where('id', $id)->count() == 0) return response()->json([
                'status' => 0,
                'data' => 'not_found'
            ]);
            $ticketMessage = new TicketsMessage();
            $ticketMessage->ticketId = $id;
            $ticketMessage->userId = ($request->input('sendAdmin') == true && Auth::user()->admin == 1) ? null : Auth::id();
            $ticketMessage->message = $request->input('message');
            if ($request->hasFile('img'))
            {
                $image      = $request->file('img');
                $image_name = time() . '.' . $image->extension();
                $image->move(public_path('ticketsImg'), $image_name);
                $ticketMessage->attachments = $image_name;
            }
            $ticketMessage->save();

            return response()->json([
                'status' => 1,
                'data' => 'ok'
            ]);
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' | ' . __FUNCTION__ . ' | ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function userTickets($status = 0)
    {
        $tickets = Tickets::where([
            ['userId', Auth::id()],
            ['status', $status == 0 ? '>=' : '=', $status]
        ])->orderBy('created_at', 'desc')->paginate(5);
        return view('tickets', ['data' => $tickets]);
    }

    public function createTicket()
    {
        return view('ticketCreate');
    }

    public function viewTicket($id)
    {
        $ticket = Tickets::where('id', $id)->first();
        $messages = TicketsMessage::where('ticketId', $id)->get();
        return view('ticketsView', ['data' => $ticket, 'messages' => $messages]);
    }
}
