<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {

//        $users_in_suggestion_tab = User::query()
//            ->ForSuggestionTab()
//            ->get();

//        $user_not_in_requests = RequestModel::query()
//            ->where('user_from', '!=', auth()->user()->id)
//            ->where('user_to', '!=', auth()->user()->id)
//            ->get();
//
//        $user_not_in_connections = Connection::query()
//            ->where('user_from', '!=', auth()->user()->id)
//            ->where('user_to', '!=', auth()->user()->id)
//            ->get();
//
//
//        $merged = $user_not_in_requests->merge($user_not_in_connections);

        $users = User::whereNotIn('id', function($query) {
                $query->select('user_from')
                    ->from('connections')
                    ->unionAll(
                        $query->select('user_to')
                            ->from('connections')
                    )
                    ->unionAll(
                        $query->select('user_from')
                            ->from('requests')
                    )
                    ->unionAll(
                        $query->select('user_to')
                            ->from('requests')
                    );
            })
            ->get();

        dd($users);

//        $users = [];

//        foreach ($merged as $item) {
//            $users[] = User::query()
//                ->where('id', '!=', auth()->user()->id)
//                ->where('id', '!=', $item->user_from)
//                ->where('id', '!=', $item->user_to)
//                ->get();
//        }
//
//        dd($users);

//        dd($users_in_suggestion_tab->toArray());

        $users_in_sent_request_tab = User::query()
            ->ForSentTab()
            ->get();

//        dd($users_in_sent_request_tab->toArray());

        $users_in_received_request_tab = User::query()
            ->ForReceivedTab()
            ->get();

//        dd($users_in_received_request_tab->toArray());

        return view('home',[
//            'users_in_suggestion_tab' => $users_in_suggestion_tab,
            'users_in_sent_request_tab' => $users_in_sent_request_tab,
            'users_in_received_request_tab' => $users_in_received_request_tab,
        ]);
    }
}
