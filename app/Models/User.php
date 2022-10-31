<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function systemAdmin(): self
    {
        $admin =  self::where('email', config('square-blog.system_admin_email'))->first();

        if (!$admin) {
            return self::createAdmin('password');
        }

        return $admin;
    }

    public static function createAdmin($password)
    {

        $user = [
            'name' => 'Admin',
            'email' => config('square-blog.system_admin_email'),
            'password' => Hash::make($password)
        ];

        return self::updateOrCreate(['email' => $user['email']], $user);
    }
}
