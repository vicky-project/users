<?php
namespace Modules\Users\Constants;

class Permission
{
  const ACCESS_USERS = "accesss.users";

  public static function all():array {
    return [self::ACCESS_USERS => 'Access users module'];
  }
}