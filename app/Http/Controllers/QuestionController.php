<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionEditRequest;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Частный инвестор')) {
            $questions = Question::where('user_id', auth()->id())->get();
            return view('questions.index', compact(['questions']));

        } else

            return view('questions.index');

    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(QuestionStoreRequest $request)
    {
        Question::create($request->all());
        return redirect()->route('questions.index')->with('success', true);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        if (auth()->user()->can('Ответить на вопрос')) {
            $question = Question::find($id);
            return view('questions.edit', compact(['question']));
        }
    }

    public function update(QuestionEditRequest $request, $id)
    {
        $question = Question::find($id);
        $question->update([
            'answer' => $request->answer,
            'what_is' => $request->what_is ?: false
        ]);

        return redirect()->route('questions.index');
    }

    public function destroy($id)
    {
        //
    }
}
