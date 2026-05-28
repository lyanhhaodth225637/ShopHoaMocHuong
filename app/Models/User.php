<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'name',
        'email',
        'password',
        'google2fa_secret',
        'google2fa_enabled_at',
        'current_session_id',
    ];

    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }

    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'google2fa_enabled_at' => 'datetime',
        'google2fa_secret' => 'encrypted',
    ];

    public function hasTwoFactorEnabled(): bool
    {
        return !empty($this->google2fa_secret) && !is_null($this->google2fa_enabled_at);
    }
    public function inputSlips()
    {
        return $this->hasMany(InputSlip::class, 'created_by', 'id');
    }

    public function outputSlips()
    {
        return $this->hasMany(OutputSlip::class, 'created_by', 'id');
    }

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class, 'created_by', 'id');
    }
}
