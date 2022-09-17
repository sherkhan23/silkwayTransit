<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class Paths extends Controller
{
    public function order(){
        $transitPath = \App\Models\Paths::query();

        $users = DB::table('users')->where('role', '=', 'driver')->get();

        $paths = $transitPath
            ->join('locomatives', function ($join) {
                $join->on('paths.locomative_id', '=', 'locomatives.id');
            })
            ->join('users', function ($join) {
                $join->on('paths.user_id', '=', 'users.id');
            })
            ->paginate();

        return view('inc.order', compact('paths','users'));

    }

}
