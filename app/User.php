<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\MailResetPasswordNotification;
use App\Notifications\VerifyApiEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'username','email', 'password','cellphone','ipAddress','country_id','currency_id','referrer_id','email_verified_at', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    ////---------------------------------------------------Relationships--------------------------------------------////

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    //Country Relationship
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    
    //Payment Detail Relationship
    public function payment_details()
    {
        return $this->hasMany('App\PaymentDetail');
    }

    //Investment Relationship
    public function investments()
    {
        return $this->hasMany('App\Investment');
    }

    //ReferralBonus Relationship
    public function referral_bonuses()
    {
        return $this->hasMany('App\ReferralBonus');
    }

    //Bonus Relationship
    public function bonuses()
    {
        return $this->hasMany('App\Bonus');
    }

    //Withdrawal Relationship
    public function withdrawals()
    {
        return $this->hasMany('App\Withdrawal');
    }

    //MarketPlace Relationship
    public function market_places()
    {
        return $this->hasMany('App\MarketPlace');
    }

    //Notification Relationship
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    //OnlineUser Relationship
    public function online_users()
    {
        return $this->hasMany('App\OnlineUser');
    }

     
    /**
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    //Pending Payment Relationship
    public function pending_payments()
    {
        return $this->hasManyThrough('App\PendingPayment', 'App\MarketPlace');
    }

    //Offers Relationship
    public function offers()
    {
        return $this->hasMany('App\PendingPayment');
    }

    //Currency Relationship
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }

    ////---------------------------------------------------Other Functions--------------------------------------------////
    //API Email Verification
    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmail); // my notification
    }

    // public function sendPasswordResetNotification($token)
    // {
    
    //     $this->notify(new App\Notifications\MailResetPasswordNotification($token));
    
    // }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['referral_link']; //add referral link when querying a user

    /**
     * Get the user's referral link.
     *
     * @return string
     */

    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['ref' => $this->username]);
    }
    

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }    
    
}
