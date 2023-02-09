<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, InteractsWithMedia;

    const AVATAR_PLACEHOLDER = 'https://ui-avatars.com/api/?background=random&name=';
    const COLLECTION_AVATAR = 'avatar';
    const CONVERSION_SIZE = ['width' => '200', 'height' => '200'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'reset_password_at',
        'oauth_id',
        'oauth_type',
        'access_token'
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
        'reset_password_at' => 'datetime'
    ];
    /**
     * @var array
     */
    protected $appends = ['avatar'];
    public $with = ["media"];

    /**
     * @return HasOne
     */
    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'user_id', 'id')->when(function ($query) {
            return $query->orderBy('status', 'DESC');
        }, function ($query) {
            return $query->orderBy('created_at', 'DESC');
        });
    }

    /**
     * Get address applied
     */
    public function getAddressApplied()
    {
        return $this->addresses->where('status', STATUS_ADDRESS_APPLIED)->first();

    }

    /**
     * Get the user's first name.
     *
     * @param string $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        $avatar = $this->getFirstMediaUrl(self::COLLECTION_AVATAR);
        if ($avatar) {
            return $avatar;
        }

        return self::AVATAR_PLACEHOLDER . trim($this->name);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection(self::COLLECTION_AVATAR)
            ->singleFile()
            ->withResponsiveImages();
    }

    public static function verify($email, $password)
    {
        $user = User::where('email', $email)->orWhere('name', $email)->first();

        if (!empty($user->id) && Hash::check($password, $user->getAuthPassword()) !== false) {
            return $user;
        } else {
            return false;
        }
    }

}
