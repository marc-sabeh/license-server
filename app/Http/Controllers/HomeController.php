<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use App\Models\License_equiments;
use App\Models\License_features;
use App\Models\License_info;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $license_features= License_features::all();
        $equiments = Equipments::all();

        
        $user = Auth::user();
        $license = null;
        if($user->license_info_id != null)
        {
            $license_info = License_info::where('id', $user->license_info_id)->get();
            $license = $license_info[0]->license_key;
        }


        return view('home')->with('license_features', $license_features)->with('equiments', $equiments)->with('license', $license);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $license_key = sha1(time());
       $license_features= License_features::where('id', $request->input('license'))->get();
       

       $date_now = Carbon::now();
       $expiry_date = Carbon::now();
       $expiry_date = $expiry_date->addDays($license_features[0]->life_span);

        $license =new License_info();
        $license->license_features_id= $license_features[0]->id;
        $license->license_key= $license_key;
        $license->date_of_purchase= $date_now->toDateTimeString();
        $license->start_date= $date_now->toDateTimeString();
        $license->expiry_date= $expiry_date->toDateTimeString();
        $license->save();

        $user = Auth::user();


        $user_save =User::find($user->id);
        $user_save->license_info_id=$license->id;
        $user_save->save();

        
        $equiments = $request->input('equiments');

        foreach($equiments as $key=>$equiment)
        {
            $license_equiments =new License_equiments();
            $license_equiments->license_info_id= $license->id;
            $license_equiments->equiment_id= $equiment;
            $license_equiments->save();
        }


       return redirect('/home')->with('success','License has been Created');
    }
}
