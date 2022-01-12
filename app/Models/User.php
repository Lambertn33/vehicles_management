<?php

namespace App\Models;
use App\Traits\Uuids;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'names',
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
        'id'=>'string'
    ];
    /**
     * Find the user instance for the given username.
     *
     * @param $username
     * @return User
     */
    public function findForPassport($email, $column)
    {
        return $this->where($column, 'LIKE', $email)
            ->first();
    }

    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
    public function profile()
    {
        return [
            'id' => $this->id,
            'names' => $this->names,
            'email' => $this->email,
            'created_at' => $this->created_at->format('F d, Y'),
            'updated_at' => $this->created_at->format('F d, Y'),
        ];
    }
}
