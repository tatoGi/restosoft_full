<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTypeAttribute()
    {

        return Config::get('userTypes.'.$this->type_id);
    }

    public function isType($user_type)
    {

        return $this->type_id <= array_search($user_type, Config::get('userTypes'));
    }

    public function isStrictType($user_type)
    {

        return $this->type_id = array_search($user_type, Config::get('userTypes'));
    }

    /**
     * Get the UserLog associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function log(): HasOne
    {
        return $this->hasOne(UserLog::class, 'user_id', 'id');
    }

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
