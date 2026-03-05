<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;

class UsersDatabaseSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    // Reset cached roles and permissions
    app()[
      \Spatie\Permission\PermissionRegistrar::class
    ]->forgetCachedPermissions();
    $this->call(PermissionSeeder::class);

    // Reset cached roles and permissions
    app()[
      \Spatie\Permission\PermissionRegistrar::class
    ]->forgetCachedPermissions();
    $this->call(RoleSeeder::class);

    // Reset cached roles and permissions
    app()[
      \Spatie\Permission\PermissionRegistrar::class
    ]->forgetCachedPermissions();
    $this->call(SuperAdminSeeder::class);

    // Reset cached roles and permissions
    app()[
      \Spatie\Permission\PermissionRegistrar::class
    ]->forgetCachedPermissions();
  }
}