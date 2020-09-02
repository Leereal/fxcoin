<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('country','roles','referrals')->paginate();
        return UserResource::collection($users);
    }  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

       //Return single package as a resource
       return new UserResource($user);
    }

    public function referrals()
    {
         $user = auth('api')->user()->id;
         $referrals = User::with('country')->where( 'referrer_id',$user)->orderByDesc('created_at')->get();
        return UserResource::collection($referrals);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth('api')->user();
        $request->validate([           
            'cellphone'      => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:7', 'max:30'],
        ]);
        $user                 = User::findOrFail($user->id);       
        $user->cellphone   = $request->input('cellphone');             
        if($user->save()){
            return ['message'=>'Saved Successfully'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
