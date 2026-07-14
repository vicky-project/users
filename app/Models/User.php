<?php
namespace Modules\Users\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Avatar\Avatar;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Modules\Users\Traits\HasAuthenticationLog;

class User extends Authenticatable
{
  use HasApiTokens,
  Notifiable,
  HasRoles,
  SoftDeletes,
  HasAuthenticationLog,
  CausesActivity,
  LogsActivity;

  /**
  * The attributes that are mass assignable.
  *
  * @var list<string>
  */
  protected $fillable = ["name",
    "email",
    "password"];

  /**
  * The attributes that should be hidden for serialization.
  *
  * @var list<string>
  */
  protected $hidden = ["password",
    "remember_token"];

  /**
  * Get the attributes that should be cast.
  *
  * @return array<string, string>
  */
  protected function casts(): array
  {
    return [
      "email_verified_at" => "datetime",
      "password" => "hashed",
    ];
  }

  /**
  * Activity Log Options
  */
  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
    ->logOnly(["name", "email", "is_active"])
    ->logOnlyDirty()
    ->dontSubmitEmptyLogs()
    ->setDescriptionForEvent(fn(string $eventName) => "User {$eventName}")
    ->useLogName("users");
  }

  /**
  * One-to-Many: User has many Activities (via Spatie Activitylog)
  */
  public function activities() {
    return $this->hasMany(
      \Spatie\Activitylog\Models\Activity::class,
      "causer_id"
    );
  }

  public function getLastActivityAttribute() {
    return $this->activities()
    ->latest()
    ->first();
  }

  public function getAvatarAttribute() {
    if ($this->socialAccounts) {
      foreach ($this->socialAccounts as $account) {
        $providerData = $account->provider_data ?? [];
        if (!empty($providerData['avatar'])) {
          return $providerData['avatar'];
        }
      }
    }

    $colorPairs = config("users.avatar.themes", []);

    $avatar = new Avatar();
    $avatar->create($this->name);
    if (!empty($colorPairs) && is_array($colorPairs)) {
      $avatar->setTheme(array_keys($colorPairs));
    }

    try {
      return $avatar->toBase64();
    } catch(\Exception $e) {
      $hash = md5(strtolower(trim($this->email)));
      return "https://www.gravatar.com/avatar/{$hash}?s=200&d=mp";
    }
  }

  public function notifyAuthenticationLogVia() {
    $stack = config("users.notifications.stack");

    return !is_string($stack) ? ["database"] : explode(",", trim($stack));
  }
}