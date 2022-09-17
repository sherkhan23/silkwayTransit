<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "phoneNumber" => ["required"],
            "password" => ["required", "min:6"]
        ]);

        if(auth("web")->attempt($data)) {
            return redirect(("/"));
        }

        return redirect(route("login"))->withErrors(["email" => "Пользователь не найден, либо данные введены не правильно"]);
    }

    public function logout()
    {
        auth("web")->logout();
        return redirect(route("checkPhoneNumberExist"));
    }

    public function showRegisterForm()
    {
        $users = User::query();

        $user = $users
            ->join('stations', function ($join) {
                $join->on('users.station_id', '=', 'stations.id');
            })->paginate();

        return view('auth.register', compact('user'));
    }

    public function showForgotForm()
    {
        return view("auth.forgot");
    }


    public function register(Request $request)
    {

        $data = $request->validate([
            "name" => ["required", "string"],
            "phoneNumber" => ["required", "string", "unique:users,phoneNumber"],
            "role" => ['required'],
            "password" => ["required", "confirmed"]
        ]);


        $user = User::create([
            "name" => $data["name"],
            "phoneNumber" => $data["phoneNumber"],
            "role" => $data["role"],
            "password" => bcrypt($data["password"])
        ]);

        if($user) {
            //event(new Registered($user));
            auth("web")->login($user);
        }

        return redirect('/');
    }

    public function showProfile(Request $request)
    {
        $users = User::query();

        $userP = $users
            ->join('countries', function ($join) {
                $join->on('users.country_id', '=', 'countries.id');
            })->paginate();

        $user = \Illuminate\Support\Facades\Auth::user();

        return view("profile", compact('user', 'userP'));
    }

    public function editProfile(Request $request){
        $user = User::find(Auth::user()->id);


        if ($user){
            $user->name = $request['name'];
            $user->email = $request['email'];


            $user->save();

            return redirect()->back();
        }else{
            return redirect()->back();
        }

    }


    public function showCheckPhoneNumberExist(){
        return view('auth.checkPhoneNumberExist');
    }


    public function checkPhoneNumberExist(Request $request){

        if (isset($_GET['phoneNumber'])) {
            session_start();
            $_SESSION['phoneNumber'] = $_GET['phoneNumber'];
        }

        $data = $request->validate([
            "phoneNumber" => ["required"],
        ]);

        if (DB::table('Users')->where('phoneNumber', $data)->exists()){
            return redirect('/login');
        }
        else{
            return redirect('/register');
        }


    }



/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function show(Auth $auth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function edit(Auth $auth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auth $auth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auth $auth)
    {
        //
    }
}
