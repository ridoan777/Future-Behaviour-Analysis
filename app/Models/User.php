<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Trackers\ProgressQuiz;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_uid',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role',     // admin, enrolled, visitor
        'avatar',
        'status',
        // 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'integer',
        ];
    }

    public function userRelationWith_ProgressQuiz()
    {
        return $this->hasMany(ProgressQuiz::class, 'user_id');
    }

    // ----------------- QUERY SCOPING -----------------
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
    // ----------------- QUERY SCOPING -----------------

    // ----------------- URL FRIENDLY IMAGE -----------------
    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return asset('site_assets/dummies/dummy_man.webp');
        }

        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        return Storage::url($this->avatar);
    }
    // ----------------- URL FRIENDLY IMAGE -----------------
}
