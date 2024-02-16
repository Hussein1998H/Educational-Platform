<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstName',
        'lastName',
        'avatar',
        'address',
        'about',
        'email',
        'email_verified_at',
        'password',
        'gender',
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
        'password' => 'hashed',
    ];

    public function roles():BelongsToMany{
        return $this->belongsToMany(Role::class,'role_users');
    }
    public function courses():BelongsToMany{
        return $this->belongsToMany(Course::class,'course_users');
    }
    public function sessions():BelongsToMany{
        return $this->belongsToMany(Session::class,'session_users');
    }
    public function eductions():HasMany{
        return $this->hasMany(Education::class,'user_id');
    }
    public function skills():HasMany{
        return $this->hasMany(Skill::class,'user_id');
    }
    public function socials():HasMany{
        return $this->hasMany(Social::class,'user_id');
    }

}
