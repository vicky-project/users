<?php

return [
  'name' => 'Users',
  "hooks" => [
    "enabled" => true,
    "service" => \Modules\CoreUI\Services\UIService::class,
  ],
  "roles" => [
    "super-admin" => [
      "name" => "Super Admin",
      "permissions" => ["*"],
    ],
  ]
];