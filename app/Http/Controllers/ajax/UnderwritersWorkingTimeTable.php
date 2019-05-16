<?php

namespace App\Http\Controllers\ajax;

use App\Models\User;
use App\Transformers\UnderwritersWorkingTimeTableTransformer;
use App\Http\Controllers\Controller;

class UnderwritersWorkingTimeTable extends Controller
{
    public function __invoke()
    {
        $underwriters = User::role('Андеррайтер')->get();

        $result = datatables($underwriters)->setTransformer(new UnderwritersWorkingTimeTableTransformer())
        ->make(true);

        return $result;
    }
}
