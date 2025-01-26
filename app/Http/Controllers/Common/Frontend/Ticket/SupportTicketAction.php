<?php

namespace App\Http\Controllers\Common\Frontend\Ticket;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SupportTicketMessage;
use App\Infra\Services\SupportTicketService;
use App\Http\Requests\SupportTicketMessageRequest;

class SupportTicketAction extends Controller
{
    private SupportTicketService $supportTicketService;

    public function __construct(SupportTicketService $supportTicketService)
    {
        $this->supportTicketService = $supportTicketService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['support_tickets'] = $this->supportTicketService->allSupportTicketGet();
        return view('frontend.SupportTicket.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.SupportTicket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupportTicketMessageRequest $data)
    {
        // dd($data);
        try {
            $this->supportTicketService->storeSupportTicket($data->validated());
            return redirect()->route('supportTicket.list')->with('success', 'Message Send successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Send Message.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['supportTicket'] = $this->supportTicketService->findSupportTicketById($id);
        $data['support_messages'] = SupportTicketMessage::where('support_ticket_id', $id)->get();
        return view('frontend.SupportTicket.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $data, string $id) {}


    /**
     * Remove the specified resource from storage.
     */



    //new message
    public function createNewMessage(string $id)
    {
        $data['supportTicket'] = $this->supportTicketService->findSupportTicketById($id);
        return view('frontend.SupportTicket.newMessage', $data);
    }

    public function storeNewMessage(SupportTicketMessageRequest $data, string $id)
    {
        try {
            $this->supportTicketService->storeSupportTicketMessage($id, $data->validated());
            return redirect()->route('supportTicket.list')->with('success', 'Message Send successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Send Message .');
        }
    }
}
