<?php
namespace Modules\Users\Installations;

use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Artisan;

class PostInstallation {
  public function handle(string $moduleName) {
    try {
      Artisan::call("vendor:publish", ["--tag" => "sanctum-migrations"]);
      Artisan::call("migrate");
    } catch(\Exception $e) {
      logger()->error(
        "Failed to run post installation of users module: " .
        $e->getMessage()
      );

      throw $e;
    }
  }
}