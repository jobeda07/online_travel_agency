<?php

namespace App\Http\Controllers\Common;

use Exception;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SupportTicketMessage;
use App\Infra\Services\AdminSupportTicketService;
use App\Http\Requests\SupportTicketMessageRequest;

class AdminSupportTicketAction extends Controller
{
    private AdminSupportTicketService $supportTicketService;

    public function __construct(AdminSupportTicketService $supportTicketService)
    {
        $this->supportTicketService = $supportTicketService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['support_tickets'] = $this->supportTicketService->allSupportTicketGet();
        $data['users'] = Admin::get();
        return view('common.SupportTicket.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $data) {}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['supportTicket'] = $this->supportTicketService->findSupportTicketById($id);
        if (!$data['supportTicket']->assigned_to) {
            return redirect()->back()->with('error', 'Assign First');
        }
        $data['support_messages'] = SupportTicketMessage::where('support_ticket_id', $id)->orderBy('created_at', 'asc')->get();
        return view('common.SupportTicket.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['supportTicket'] = $this->supportTicketService->findSupportTicketById($id);
        return view('common.SupportTicket.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $data, string $id)
    {
        try {
            $this->supportTicketService->updateSupportTicket($id, $data->all());
            return redirect()->back()->with('success', 'Assigned successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->supportTicketService->deleteSupportTicket($id);
            return redirect()->back()->with('success', 'SupportTicket deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete SupportTicket.');
        }
    }


    //new message
    public function createNewMessage(string $id)
    {
        $data['supportTicket'] = $this->supportTicketService->findSupportTicketById($id);
        return view('common.SupportTicket.newMessage', $data);
    }

    public function storeNewMessage(SupportTicketMessageRequest $data, string $id)
    {
       // try {
            $this->supportTicketService->storeSupportTicketMessage($id, $data->validated());
            return redirect()->route('adminSupportTicket.show', $id)->with('success', 'Message Send successfully.');
        // } catch (Exception $e) {
        //     return redirect()->back()->with('error', 'Failed to Send Message .');
        // }
    }
}
