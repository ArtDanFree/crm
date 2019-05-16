<?php

namespace App\Http\Composers;


use Illuminate\View\View;
use App\Models\Source;
use App\Models\City;

use App\Helpers;



class ViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */


    protected $cities;
    protected $sources;
    protected $statistic = [];
    protected $leadNotification;
    protected $transactionNotifications;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository $users
     * @return void
     */


    public function __construct()
    {
        if (\Request::user()->hasRole('Частный инвестор')) {
           $this->statistic = Helpers::getChinStatistics();
        }

        if (\Request::user()->hasRole('Андеррайтер')) {
           $this->statistic = Helpers::getUnderwriterStatistics();
           $this->leadNotification = Helpers::getLeadNotification();
        }

        $this->sources = Source::all();
        $this->cities = City::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose()
    {
        \View::share([
            'sources' => $this->sources,
            'cities' => $this->cities,
            'statistic' => $this->statistic,
        ]);
    }
}
