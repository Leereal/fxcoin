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
        $total_balance = Investment::where('user_id', $user->id)->where('status', '>', 0)->get()->sum('balance');
        $total_amount = Investment::where('user_id', $user->id)->where('status', '>', 0)->get()->sum('amount');
        $total_payments = PendingPayment::with('market_place', 'market_place.user')->where('status', '=', 0)->get()->sum('amount');
        $total_referrals = User::where('referrer_id', $user->id)->where('status', '>', 0)->get()->count();
        $total_referral_bonus = ReferralBonus::where('user_id', $user->id)->where('status', '>', 0)->get()->sum('amount');
        $total_offers = PendingPayment::where('user_id', $user->id)->where('status', '=', 2)->get()->sum('amount');
        $total_sales = MarketPlace::where('user_id', $user->id)->where('status', '>', 0)->get()->sum('amount');
        $total_active_members = User::where('referrer_id', $user->id)->whereHas('investments')->active()->get()->count();
      
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
