<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OurPartnerRequest;
use App\Infra\Services\OurPartnerService;

class OurPartnerAction extends Controller
{
    private OurPartnerService $OurPartnerService;
   
    public function __construct(OurPartnerService $OurPartnerService)
    {
        $this->OurPartnerService = $OurPartnerService;
    }

    public function index()
    {
        $data['ourPartners']=$this->OurPartnerService->allOurPartnerGet();
        return view('common.ourPartner.list',$data);
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
    public function store(OurPartnerRequest $data)
    {
        try {
            $this->OurPartnerService->storeOurPartner($data->validated());
            return redirect()->route('ourPartner.list')->with('success', 'Our Partner Create successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store Our Partner.');
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
    public function update(Request $request, string $id)
    {
        try {
            $this->OurPartnerService->updateOurPartner($id,$request->all());
            return redirect()->route('ourPartner.list')->with('success', 'Our Partner  updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Our Partner .');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->OurPartnerService->deleteOurPartner($id);
            return redirect()->route('ourPartner.list')->with('success', 'Our Partner  deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Our Partner .');
        }
    }
    public function status(string $id)
    {
        try {
            $this->OurPartnerService->statusOurPartner($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }
}