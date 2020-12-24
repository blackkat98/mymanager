<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'username', 'email', 'password', 
        'is_first_name_first', 'phone', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the User's Full Name
     * 
     * @return string
     */
    public function getFullName()
    {
        if (empty($this->middle_name)) {
            $nameParts = [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
            ];
        } else {
            $nameParts = [
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
            ];
        }

        if ($this->is_first_name_first != 1) {
            $nameParts = array_reverse($nameParts);
        }

        return implode(' ', $nameParts);
    }

    public function avatar()
    {
        return $this->morphOne(MediaFile::class, 'ownable');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'user_id');
    }
}
