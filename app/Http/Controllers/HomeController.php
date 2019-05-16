<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Service\UserService;


class HomeController extends Controller
{

    private $userRepository;
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birthdays = $this->userRepository->birthdayIsComingSoon(5);
        $birthdays = $this->userService->birthdayIsComingSoon($birthdays);

        return view('home.index', compact('birthdays'));
    }
}
