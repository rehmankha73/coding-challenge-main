<?php

namespace App\Models;

use App\Constants\RequestType;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeForSuggestionTab($query)
    {
        return
            $query->join('requests', 'users.id', '=', 'requests.user_from')
            ->join('connections', 'users.id', '=', 'connections.user_from')
            ->where('requests.user_from', '!=', auth()->user()->id)
            ->where('requests.user_to', '!=', auth()->user()->id)
            ->where('connections.user_from', '!=', auth()->user()->id)
            ->where('connections.user_to', '!=', auth()->user()->id)
            ->select('users.*');
    }

    public function scopeForSentTab($query)
    {
        return $query->join('requests', 'users.id', '=', 'requests.user_from')
            ->where('requests.user_from', '=', auth()->user()->id)
            ->where('requests.status', RequestType::PENDING);
    }

    public function scopeForReceivedTab($query)
    {
        return $query->join('requests', 'users.id', '=', 'requests.user_to')
            ->where('requests.user_to', '=', auth()->user()->id)
            ->where('requests.status', RequestType::PENDING);
    }
}
