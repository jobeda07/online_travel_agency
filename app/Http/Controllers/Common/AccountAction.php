<?php

namespace App\Http\Controllers\Common;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Infra\Services\AccountService;
use App\Http\Requests\AccountHeadRequest;
use App\Http\Requests\AccountLedgerRequest;

class AccountAction extends Controller
{
    private AccountService $AccountService;

    public function __construct(AccountService $AccountService)
    {
        $this->AccountService = $AccountService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['account_heads'] = $this->AccountService->allAccountHeadGet();
        return view('common.account.accountHead.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountHeadRequest $data)
    {
        try {
            $this->AccountService->storeAccountHead($data->validated());
            return redirect()->back()->with('success', 'Account Head Create successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store Account Head.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountHeadRequest $data, string $id)
    {
        try {
            $this->AccountService->updateAccountHead($id, $data->validated());
            return redirect()->back()->with('success', 'Account Head Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update Account Head.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (in_array($id, [1, 2, 3, 4])) {
                return redirect()->back()->with('error', 'Cannot delete this Account Head.');
            }
            $this->AccountService->deleteAccountHead($id);
            return redirect()->back()->with('success', 'Account Head deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Account Head.');
        }
    }

    public function status(string $id)
    {
        try {
            $this->AccountService->statusAccountHead($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }

    public function ledgerIndex(Request $data)
    {
        $data['account_ledgers'] = $this->AccountService->allAccountLedgerGet($data->all());
        $data['account_type'] = $data->input('account_type', '');
        $data['start_date'] = $data->input('start_date', '');
        $data['end_date'] = $data->input('end_date', '');

        $data['total_debit'] = $data['account_ledgers']->sum('debit');
        $data['total_credit'] = $data['account_ledgers']->sum('credit');
        $data['total_balance'] = $data['account_ledgers']->sum('balance');
        return view('common.account.accountLedger.index', $data);
    }
    public function ledgerCreate()
    {
        $data['account_heads'] = $this->AccountService->allAccountHeadGet();
        return view('common.account.accountLedger.create', $data);
    }
    public function ledgerStore(AccountLedgerRequest $data)
    {
        try {
        $this->AccountService->storeAccountLedger($data->validated());
        return redirect()->route('account.ledger.list')->with('success', 'Account Head Create successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store Account Head.');
        }
    }
    public function ledgerEdit($id) {}
    public function ledgerUpdate($id, $data) {}
    public function ledgerDelete($id)
    {
        try {
            $this->AccountService->deleteAccountLedger($id);
            return redirect()->back()->with('success', 'Account Ledger deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Account Ledger.');
        }
    }
}
