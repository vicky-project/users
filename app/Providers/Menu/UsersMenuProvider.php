<?php
namespace Modules\Users\Providers\Menu;

use Modules\Users\Constants\Permission;
use Modules\CoreUI\Services\BaseMenuProvider;

class UsersMenuProvider extends BaseMenuProvider
{
  protected array $config = [
    "group" => "server",
    "location" => "sidebar",
    "icon" => "bi bi-server",
    "order" => 2,
    "permission" => null,
  ];

  public function __construct() {
    $moduleName = "Users";
    parent::__construct($moduleName);
  }

  /**
  * Get all menus
  */
  public function getMenus(): array
  {
    return [
      $this->item([
        "title" => "User Management",
        "icon" => "bi bi-people",
        "type" => "dropdown",
        "order" => 50,
        "children" => [
          $this->item([
            "title" => "Users",
            "icon" => "bi bi-person-gear",
            "route" => "admin.users.index",
            "order" => 1,
            "permission" => Permission::VIEW_USERS,
          ]),
          $this->item([
            "title" => "Roles",
            "icon" => "bi bi-person-check",
            "route" => "admin.roles.index",
            "order" => 2,
            "permission" => Permission::VIEW_ROLES,
          ]),
          $this->item([
            "title" => "Permissions",
            "icon" => "bi bi-person-lock",
            "route" => "admin.permissions.index",
            "order" => 3,
            "permission" => Permission::VIEW_PERMISSIONS,
          ]),
        ],
      ]),
    ];
  }
}