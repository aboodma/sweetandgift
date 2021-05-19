<?php

namespace App\Http\Controllers;

use App\TrendCustomer;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Address;
class TrendCustomerController extends Controller
{
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
     protected function validator(array $data)
     {
         return Validator::make($data, [
             'name' => 'required|string|max:255',
             'email'=>'required|unique:users',
             'password' => 'required|string|min:6|confirmed',
         ]);
     }
    public function store($id)
    {

      $client = new Client();
        $res = $client->request('GET', 'https://2rend.com/public/api/v1/booking/guest/'.$id.'/info');
        $data =  $res->getBody();
        $data = json_decode($data);
        $user = User::where('email', $data[0]->user->email)->first();
          if(!$user){
            $user = User::create([
                'name' => $data[0]->user->name,
                'email' => $data[0]->user->email,
                'password' => Hash::make($data[0]->password),
            ]);
            $user->email_verified_at = $user->created_at;
            $user->save();
            $customer = new TrendCustomer;
            $customer->user_id = $user->id;
            $customer->hotel_id = $data[0]->hotel->id;
            $customer->save();
            $address = new Address;
            $address->user_id = $user->id;
            $address->address = $data[0]->hotel->country." - ".$data[0]->hotel->city." - ".$data[0]->hotel->address." - Hotel Name :". $data[0]->hotel->name." - Room Number: ".$data[0]->room->room_number;
            $address->country = "Turkey";
            $address->city = "Istanbul";
            $address->postal_code = 34000;
            $address->phone = $data[0]->phone;
            $address->save();
          }
          return $user;



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrendCustomer  $trendCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(TrendCustomer $trendCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrendCustomer  $trendCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(TrendCustomer $trendCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrendCustomer  $trendCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrendCustomer $trendCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrendCustomer  $trendCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrendCustomer $trendCustomer)
    {
        //
    }
}
