<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Eloquent\Model as Eloquent;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    //protected $connection = 'mongodb';
    //protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'email_verified_at',
        'occupation_area',
        'link',
        'tiket_id',
        'occupation_area',
        
    ];

   
}
