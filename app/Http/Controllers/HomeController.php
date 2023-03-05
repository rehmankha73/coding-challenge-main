<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(): Factory|View|Application
    {

        $users_in_suggestion_tab = User::query()
            ->ForSuggestionTab()
            ->get();

//        dd($users_in_suggestion_tab->toSql());

        dd($users_in_suggestion_tab->toArray());

        $users_in_sent_request_tab = User::query()
            ->ForSentTab()
            ->get();

//        dd($users_in_sent_request_tab->toArray());

        $users_in_received_request_tab = User::query()
            ->ForReceivedTab()
            ->get();

        dd($users_in_received_request_tab->toArray());

        return view('home');
    }
}
