<?php

namespace App\Http\Controllers\Common;


use Illuminate\Http\Request;
use App\Models\TranslateData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Infra\Services\CustomerService;

class HomeAction extends Controller
{
    private CustomerService $customerService;
    /**
     * Create a new controller instance.
     *
     * @param CustomerService $customerService
     * @return void
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['customers'] = $this->customerService->allCustomerGet();
        return dd('ok');
        //return view('common.dashboard', $data);
    }

    public function setLanguage($lang_code)
    {
        //dd($lang_code);
        session(['selected_language' => $lang_code]);

        Cache::forget('translations');
        Cache::remember('translations', now()->addDay(), function () {
            return TranslateData::all()->groupBy('lang_code')->map(function ($group) {
                return $group->keyBy('key');
            });
        });
        return redirect()->back();
    }
}
