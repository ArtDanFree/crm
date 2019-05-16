<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Service\UserService;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function __invoke(UserRepository $userRepository, UserService $userService)
    {
        $birthdays = $userRepository->birthdayIsComingSoon();
        $birthdays = $userService->birthdayIsComingSoon($birthdays);

        return view('birthday', compact(['birthdays']));
    }
}
