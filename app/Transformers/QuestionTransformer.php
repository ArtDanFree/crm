<?php

namespace App\Transformers;

use App\Models\Question;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract
{
    public function transform(Question $question)
    {
        return [
            'DT_RowClass' => $this->rowClass($question),
            $question->question,
            $question->answer ?: '-',
            $question->what_is ? 'Да' : 'Нет',
            '<a href="'. Route('questions.edit', $question->id) .'" class="btn btn-info">Редактировать</a>'
        ];
    }

    public function rowClass($question)
    {
        if ($question->what_is) {
            return 'success';
        }elseif(!$question->answer){
            return 'info';
        }

    }
}