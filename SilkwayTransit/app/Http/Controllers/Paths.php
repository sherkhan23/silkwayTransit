<?php

namespace App\Http\Controllers;

use App\Models\Locomatives;
use App\Models\stations;
use App\Models\Transitions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Paths extends Controller
{
    public function order(){
        $transitPath = \App\Models\Paths::query();

        $users = DB::table('users')->where('role', '=', 'driver')->get();
        $locomative = Locomatives::all();

        $stations = stations::all();

        $paths = $transitPath
            ->join('locomatives', function ($join) {
                $join->on('paths.locomative_id', '=', 'locomatives.id');
            })
            ->join('users', function ($join) {
                $join->on('paths.user_id', '=', 'users.id');
            })
            ->join('transitions', function ($join) {
                $join->on('paths.transition_id', '=', 'transitions.id');
            })
            ->paginate();

        return view('inc.order', compact('paths','users', 'locomative', 'stations'));

    }

    public function order_process(Request $request)
    {

        $user = User::find(Auth::user()->id);

        if ($user) {

            $transit = Transitions::create([
                "station1_id" => $request["station1_id"],
                "station2_id" => $request["station2_id"],
                "st1deportTime" => $request["st1deportTime"],
                "st2arriveTime" => $request["st2arriveTime"],
            ]);

            $transit->save();

            $paths = Paths::create([
                "locomative" => $request["locomative"],
                "driver" => $request["driver1"],
            ]);

            $paths->save();

            redirect('/order');

        }

    }



}
