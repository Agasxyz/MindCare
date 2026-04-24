<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pertanyaan;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Pertanyaan::all();
        return view('admin.question', compact('questions'));
    }

    public function create()
    {
        return view('admin.question-edit', ['question' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
        ]);

        Pertanyaan::create($request->all());

        return redirect()->route('admin.question')->with('success', 'Question created successfully');
    }

    public function edit($id)
    {
        $question = Pertanyaan::findOrFail($id);
        return view('admin.question-edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required',
        ]);

        $question = Pertanyaan::findOrFail($id);
        $question->update($request->all());

        return redirect()->route('admin.question')->with('success', 'Question updated successfully');
    }

    public function destroy($id)
    {
        $question = Pertanyaan::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.question')->with('success', 'Question deleted successfully');
    }
}
