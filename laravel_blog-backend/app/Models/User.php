<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
//    /**
//     * Find the user instance for the given username.
//     *
//     * @param  string  $username
//     * @return \App\Models\User
//     */
//    public function findForPassport($username)
//    {
//        return $this->where('username', $username)->first();
//    }
//    /**
//     * Validate the password of the user for the Passport password grant.
//     *
//     * @param  string  $password
//     * @return bool
//     */
//    public function validateForPassportPasswordGrant($password)
//    {
//        return Hash::check($password, $this->password);
//    }

    public function posts(){
        return $this->hasMany(Posts::class,'user_id');
    }
}
