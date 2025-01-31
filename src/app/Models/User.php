<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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

    //一人のユーザーが複数の商品を持っている
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**一人のユーザーとそのユーザーのprofileが紐づく */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    //ひとりのUserが複数のLikeを持っている
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //一人のUserが複数のCommentを持っている
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //一人のUserが複数のPurchaseを持っている
    public function purchases()
    {
        return $this->belongsToMany(Item::class, 'purchases');
    }
}
