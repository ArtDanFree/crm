<?php

namespace App\Http\Controllers\ajax;

use App\Models\Question;
use App\Transformers\QuestionTransformer;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->hasRole('Администратор')) {
            return $this->admin();
        }
    }

    public function admin()
    {
        $questions = datatables(Question::all())
            ->setTransformer(new QuestionTransformer())
            ->make(true);
        return $questions;
    }
}
