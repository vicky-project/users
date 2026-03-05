<?php
namespace Modules\Users\Constants;

class Permission
{
  const ACCESS_USERS = "accesss.users";
  const VIEW_USERS = "view.users";
  const VIEW_ROLES = "view.roles";
  const VIEW_PERMISSIONS = "view.permissions";

  public static function all():array {
    return [self::ACCESS_USERS => 'Access users module',
      self::VIEW_USERS => 'View all users',
      self::VIEW_ROLES => 'View all user roles',
      self::VIEW_PERMISSIONS => 'View all user permissions'];
  }
}