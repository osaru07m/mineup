<?php

namespace App\Models\Users;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /** @var string アクティブステータス */
    public const STATUS_ACTIVE = 'active';
    /** @var string 承認待ちステータス */
    public const STATUS_PENDING = 'pending';
    /** @var string ロック済みステータス */
    public const STATUS_LOCKED = 'locked';

    public const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_PENDING,
        self::STATUS_LOCKED
    ];

    public const STATUS_LABELS = [
        self::STATUS_ACTIVE => 'アクティブ',
        self::STATUS_PENDING => '承認待ち',
        self::STATUS_LOCKED => 'ロック済み'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'first_name',
        'last_name',
        'status',
        'language',
        'is_admin',
        'last_logged-in_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_change_password_required' => 'boolean',
            'last_logged-in_at' => 'datetime',
        ];
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName(): string
    {
        return 'login';
    }

    public function activities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }
}
