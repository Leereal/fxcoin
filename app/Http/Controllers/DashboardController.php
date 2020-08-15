<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investment;
use App\PendingPayment;
use App\User;
use App\ReferralBonus;
use App\MarketPlace;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth('api')->user();
        $total_balance          = $user->investments()->where('status', '>', 0)->get()->sum('balance');
        $total_amount           = $user->investments()->where('investments.status', '>', 0)->get()->sum('amount');
        $total_payments         = $user->pending_payments()->where('pending_payments.status', '=', 0)->get()->sum('amount');
        $total_referrals        = $user->referrals()->where('status', '>', 0)->get()->count();
        $total_referral_bonus   = $user->referral_bonuses()->where('referral_bonuses.status', '>', 0)->get()->sum('amount');
        $total_offers           = $user->offers()->where('pending_payments.status', '=', 2)->get()->sum('amount');
        $total_sales            = $user->market_places()->where('market_places.status', '>', 0)->get()->sum('amount');
        $total_active_members   = $user->referrals()->has('investments')->active('referrals')->get()->count();
      
        return $totals = [
            'balance' => number_format($total_balance, 2),
            'amount'  => number_format($total_amount, 2),
            'payment'  => number_format($total_payments, 2),
            'referrals'  =>$total_referrals,
            'referral_bonus'  => number_format($total_referral_bonus, 2),
            'offers'  => number_format($total_offers, 2),
            'sales'  => number_format($total_sales, 2),
            'active_members'  => $total_active_members,
        ];
    }
}
