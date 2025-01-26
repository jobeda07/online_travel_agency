<?php

namespace App\Http\Controllers\Common;

use Exception;
use App\Models\keyValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Infra\Services\LanguageService;

class LanguageAction extends Controller
{
    private LanguageService $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['languages'] = $this->languageService->alllanguageGet();
        // dd($data['countries']);
        return view('common.language.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('common.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $data)
    {
        try {
            $this->languageService->storelanguage($data->validated());
            return redirect()->route('language.list')->with('success', 'language Create successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store language.');
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
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:80|unique:languages,name,' . $id,
            'lang_code' => 'required|min:2|max:8|unique:languages,lang_code,' . $id,
        ]);
        try {
            $this->languageService->updatelanguage($id, $validatedData);
            return redirect()->route('language.list')->with('success', 'language updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update language.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->languageService->deletelanguage($id);
            return redirect()->route('language.list')->with('success', 'language deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete language.');
        }
    }
    public function status(string $id)
    {
        try {
            $this->languageService->statuslanguage($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }
    public function translation(string $id)
    {
        $data['language'] = $this->languageService->findlanguageById($id);
        $data['key_values'] = $this->languageService->allkeyValueGet($id);
       // $data['translate_Data'] = $this->languageService->findlanguageData($id);
        return view('common.language.translation', $data);
    }
    public function translation_store(Request $request, string $id)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'key' => 'nullable|array',
            'description' => 'nullable|array',
        ]);
        try {
            $this->languageService->translationStore($id, $validatedData);
            return redirect()->route('language.list')->with('success', 'language Translation updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Translation.');
        }
    }
}
