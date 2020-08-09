<?php

namespace App\Http\Controllers;

use App\ReferralBonus;
use Illuminate\Http\Request;

use App\Http\Resources\ReferralBonusResource;

class ReferralBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referral_bonus = ReferralBonus::paginate();
        return ReferralBonusResource::collection($referral_bonus);
    }

    public function user_referral_bonus()
    {
        $referral_bonuses = ReferralBonus::where('user_id',auth('api')->user()->id)->paginate();
        return ReferralBonusResource::collection($referral_bonuses);
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
     * @param  \App\ReferralBonus  $referralBonus
     * @return \Illuminate\Http\Response
     */
    public function show(ReferralBonus $referralBonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReferralBonus  $referralBonus
     * @return \Illuminate\Http\Response
     */
    public function edit(ReferralBonus $referralBonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReferralBonus  $referralBonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReferralBonus $referralBonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReferralBonus  $referralBonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReferralBonus $referralBonus)
    {
        //
    }
}
