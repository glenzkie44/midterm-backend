<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use Exception;

class ToolController extends Controller
{
    public function show(Tool $tool) {
        return response()->json($tool,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $tools = Tool::where('title','like',"%$request->key%")
            ->orWhere('description','like',"%$request->key%")->get();

        return response()->json($tools, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'brand' => 'string|required',
            'description' => 'string|required',
            'price' => 'numeric|required',
            'acquired_on' => 'date|required',
        ]);

        try {
            $tool = Tool::create($request->all());
            return response()->json($tool, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Tool $tool) {
        try {
            $tool->update($request->all());
            return response()->json($tool, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Tool $tool) {
        $tool->delete();
        return response()->json(['message'=>'Tool deleted.'],202);
    }

    public function index() {
        $tools = Tool::orderBy('name')->get();
        return response()->json($tools, 200);
    }
}
