<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\MailResetPasswordNotification;
use App\Notifications\VerifyApiEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'username','email', 'password','cellphone','ipAddress','country_id','referrer_id','email', 'password',
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

    //API Email Verification
    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmail); // my notification
    }

    // public function sendPasswordResetNotification($token)
    // {
    
    //     $this->notify(new App\Notifications\MailResetPasswordNotification($token));
    
    // }
    //Roles Relationship
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

    // //Referral Relationship
    // public function referrals()
    // {
    //     return $this->hasMany('App\Referral');
    // }

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
    public function online_user()
    {
        return $this->belongsTo('App\OnlineUser');
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['referral_link'];

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
