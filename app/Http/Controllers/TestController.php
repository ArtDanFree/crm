<?php

namespace App\Http\Controllers;

use App\Events\Test;
use Event;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        Event::fake();

    }
}
