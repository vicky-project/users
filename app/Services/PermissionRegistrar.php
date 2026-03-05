<?php

namespace Modules\Users\Services;

use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;

class PermissionRegistrar
{
  /**
  * Register and sync permissions for all modules
  */
  public function syncAllPermissions(): void
  {
    $activeModules = Module::allEnabled();

    foreach ($activeModules as $module) {
      $this->syncModulePermissions($module->getName());
    }
  }

  /**
  * Sync permissions for specific module
  */
  public function syncModulePermissions(string $moduleName): void
  {
    $permissions = $this->getModulePermissions($moduleName);

    foreach ($permissions as $permissionName => $description) {
      Permission::firstOrCreate(
        ["name" => $permissionName, "guard_name" => "web"],
        [
          "description" => $description,
        ],
      );
    }
  }

  /**
  * Get permission configuration from module
  */
  public function getModulePermissions(string $moduleName): array
  {
    $className = "Modules\\{$moduleName}\\Constants\\Permission";

    if (!class_exists($className)) {
      return [];
    }

    return $className::all();
  }

  /**
  * Get all permissions from all active module.
  */
  public function getAllPermissions(): array
  {
    $allPermissions = [];
    $activeModules = Modules::isEnabled();

    foreach ($activeModules as $module) {
      $modulePermissions = $this->getModulePermissions($module->getName());
      $allPermissions = array_merge($allPermissions, $modulePermissions);
    }

    return $allPermissions;
  }
}