<?php

namespace App\Http\Controllers\Common;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Infra\Services\SettingService;

class SettingAction extends Controller
{
    private SettingService $settingService;
    public function __construct(SettingService $settingService){
        $this->settingService=$settingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['setting']= $this->settingService->firstID();
        return view('common.setting.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $data)
    {
        try {
            $this->settingService->storeSetting($data->all());
            return redirect()->route('setting.list')->with('success', 'Setting Added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store Setting.');
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
    public function update(Request $request)
    {
        try {
            $this->settingService->updatesetting($request->all());
            return redirect()->route('setting.list')->with('success', 'Setting updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Setting.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
