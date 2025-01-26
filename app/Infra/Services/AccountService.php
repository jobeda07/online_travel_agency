<?php

namespace App\Infra\Services;

use App\Infra\Repositories\AccountRepository;

class AccountService
{
    private AccountRepository $AccountRepository;

    public function __construct(
        AccountRepository $AccountRepository,
    ) {
        $this->AccountRepository = $AccountRepository;
    }

    public function allAccountHeadGet()
    {
        $accountHead = $this->AccountRepository->allAccountHeadGet();
        return $accountHead;
    }
    public function storeAccountHead(array $data)
    {
        return $this->AccountRepository->storeAccountHead($data);
    }

    public function findAccountHeadById($id)
    {
        return $this->AccountRepository->findAccountHeadById($id);
    }

    public function updateAccountHead($id, array $data)
    {
        return $this->AccountRepository->updateAccountHead($id, $data);
    }
    public function deleteAccountHead($id)
    {
        return $this->AccountRepository->deleteAccountHead($id);
    }

    public function statusAccountHead($id)
    {
        return $this->AccountRepository->statusAccountHead($id);
    }
    public function allAccountLedgerGet(array $data)
    {
        $accountHead = $this->AccountRepository->allAccountLedgerGet($data);
        return $accountHead;
    }
    public function storeAccountLedger(array $data)
    {
        return $this->AccountRepository->storeAccountLedger($data);
    }
    public function deleteAccountLedger($id)
    {
        return $this->AccountRepository->deleteAccountLedger($id);
    }
}
