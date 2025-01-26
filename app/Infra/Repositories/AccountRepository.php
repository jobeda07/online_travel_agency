<?php

namespace App\Infra\Repositories;

use App\Models\AccountHead;
use App\Models\AccountLedger;

class AccountRepository
{
    private AccountHead $AccountHead;
    private AccountLedger $AccountLedger;

    public function __construct(AccountHead $AccountHead, AccountLedger $AccountLedger)
    {
        $this->AccountHead = $AccountHead;
        $this->AccountLedger = $AccountLedger;
    }

    public function allAccountHeadGet()
    {
        $accountheads = $this->AccountHead->get();
        return $accountheads;
    }

    public function storeAccountHead(array $data)
    {
        $AccountHead = new AccountHead();
        $AccountHead->title = $data['title'];
        $AccountHead->status = 1;
        $AccountHead->save();
        return $AccountHead;
    }

    public function findAccountHeadById($id)
    {
        return $this->AccountHead->findOrFail($id);
    }

    public function updateAccountHead($id, array $data)
    {
        $AccountHead = $this->findAccountHeadById($id);
        $AccountHead->title = $data['title'];
        $AccountHead->status = $AccountHead->status;
        $AccountHead->save();
        return $AccountHead;
    }
    public function deleteAccountHead($id)
    {
        $AccountHead = $this->AccountHead->find($id);
        if ($AccountHead) {
            return $AccountHead->delete();
        }
    }

    public function statusAccountHead($id)
    {
        $AccountHead = $this->AccountHead->find($id);
        $AccountHead->status = $AccountHead->status == 1 ? 0 : 1;
        $AccountHead->save();
        return $AccountHead;
    }
  
    public function allAccountLedgerGet(array $data)
    {
        $startDate = isset($data['start_date']) ? date('Y-m-d', strtotime($data['start_date'])) : null;
        $endDate = isset($data['end_date']) ? date('Y-m-d', strtotime($data['end_date'])) : null;
        $account_type = $data['account_type'] ?? null;

        $accountLedgers = $this->AccountLedger->query();

        if (!empty($account_type) && $startDate && $endDate) {
            $accountLedgers->where(function ($query) use ($startDate, $endDate, $account_type) {
                $query->whereBetween('created_at', [$startDate, $endDate])
                    ->where('account_type', $account_type);
            });
        } elseif ($startDate && $endDate) {
            $accountLedgers->whereBetween('created_at', [$startDate, $endDate]);
        }
        return $accountLedgers->get();
    }

    public function storeAccountLedger(array $data)
    {
        $amount = get_account_balance();
        $AccountLedger = new AccountLedger();
        $AccountLedger->account_head_id = $data['account_head_id'];
        $AccountLedger->particulars = $data['particulars'];
        $AccountLedger->account_type = $data['account_type'];
        if ($AccountLedger->account_type == 1) {
            $AccountLedger->debit = $data['amount'];
            $AccountLedger->balance = $amount - $data['amount'];
        } else if ($AccountLedger->account_type == 2) {
            $AccountLedger->credit = $data['amount'];
            $AccountLedger->balance = $amount + $data['amount'];
        }
        $AccountLedger->save();
        return $AccountLedger;
    }

    public function deleteAccountLedger($id)
    {
        $AccountLedger = $this->AccountLedger->find($id);
        if ($AccountLedger) {
            return $AccountLedger->delete();
        }
    }
}
