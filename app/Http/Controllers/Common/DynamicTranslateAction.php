<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DynamicTranslate;

class DynamicTranslateAction extends Controller
{
    public function store(Request $request){
        $request->validate([
            'model_name' => 'required|string',
            'lang_code' => 'required|string',
            'key_id' => 'required|integer',
            'key_name' => 'required|array',
            'key_name.*' => 'required|string',
            'value' => 'required|array',
            'value.*' => 'required|string',
        ]);
        foreach($request->key_name as $key=>$name){
            $dynamic_Data = DynamicTranslate::updateOrCreate(
                [
                    'model_name' => $request->model_name,
                    'lang_code' => $request->lang_code,
                    'key_id' => $request->key_id,
                    'key_name' => $name,
                ],
                [
                    'value' => $request->value[$key],
                ]
            );
        }
        
        return back()->with('success', 'Translate add successfully.');
       
    }
}