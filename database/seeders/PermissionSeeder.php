<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Modules\Users\Services\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
  protected $moduleName = "Users";

  public function run() {
    $permissionRegistry = new PermissionRegistrar();

    $permissionConfig = $permissionRegistry->syncModulePermissions(
      $this->moduleName
    );
  }
}