<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\JwtTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Crypt;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @method static where(string $string, mixed $accountId)
 * @method static select(string $string)
 * @property mixed keepLogging
 * @property Carbon|mixed lastLoginAt
 * @property mixed email
 * @property mixed password
 * @property mixed locale
 * @property mixed phone
 * @property mixed birthday
 * @property mixed lastName
 * @property mixed firstName
 * @property mixed gender
 * @property mixed|string id
 * @property mixed|string|null accountNumber
 */
class Account extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use HasFactory, Authenticatable, Authorizable, SoftDeletes, JwtTrait;

    protected $dates = ['lastLoginAt', 'createdAt, updatedAt, deletedAt'];
    const DELETED_AT = 'deletedAt';
    const UPDATED_AT = 'updatedAt';
    const CREATED_AT = 'createdAt';
    protected $connection = 'data';
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'passwordForgottenToken',
        'passwordForgottenTokenLimit'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function generateAccountNumber($numberOfGeneration = 1): ?string
    {
        $currentDate = \Illuminate\Support\Carbon::now();
        $yy = $currentDate->format('y') * 2;
        $mm = $currentDate->format('m') * 2;
        $dd = $currentDate->format('d') * 2;

        $nextAccountNumber =
            str_pad($yy, 2, 0, STR_PAD_LEFT) .
            str_pad($mm, 2, 0, STR_PAD_LEFT) .
            str_pad($dd, 2, 0, STR_PAD_LEFT) .
            str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $checkAvailability = Account::where('accountNumber', $nextAccountNumber)->withTrashed();

        if ($checkAvailability->count() == 0) {
            return $nextAccountNumber;
        }

        if ($numberOfGeneration === 10) {
            return null;
        }

        $this->generateAccountNumber($numberOfGeneration + 1);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        $customClaims = Account::where('id', $this->id);

        $profile = [
            'locale' => $customClaims->first()->locale,
            'account' => $customClaims->first()->toArray()
        ];

        return [
            'profile' => (Crypt::encrypt($profile))
        ];
    }
}
