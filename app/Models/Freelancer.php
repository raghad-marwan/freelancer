<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Freelancer extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $fillable = [
         'name',
        'email',
        'password',
        'verification_token',
        'verification_token_sent_at',
        'email_verified_at',

    ];
}
