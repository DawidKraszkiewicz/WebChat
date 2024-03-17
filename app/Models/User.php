<?php

namespace App\Models;


use App\Constants\UserRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

/**
 * @property int $id
 * @property int $role_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $phone
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property boolean $is_first_login
 * @property string $remember_token
 * @property string|null $last_login_at
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $deleted_at
 *
 * @property Role $role
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Searchable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'role_id',
        'is_first_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_first_login' => 'bool',
    ];

    public function toSearchableArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }

    public function role(): HasOne
    {
        return $this->hasOne('roles', 'id', 'role_id');
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isFirstLogin(): bool
    {
        return $this->is_first_login;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLastLoginAt(): ?string
    {
        return $this->last_login_at;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function isAdmin(): bool
    {
        return $this->role_id === UserRoles::ADMIN;
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }
}
