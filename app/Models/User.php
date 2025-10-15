<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Support\Facades\Cache;
// use App\Models\Shop;


class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable;
 use HasRolesAndPermissions;
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

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')->withPivot('role_id');
    }

    public function descussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
    public function getImageAttribute($value)
    {
        return $value ? $value : "avatar.png";
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
