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
  ],
  "avatar" => [
    "themes" => [
      "ungu-gelap" => [
        'backgrounds' => ["#1E1E2F"],
        'foregrounds' => ["#F5EFFF"]
      ],
      // ungu gelap & putih keunguan
      "biru-tua" => [
        'backgrounds' => ["#2C3E50"],
        'foregrounds' => ["#ECF0F1"]
      ],
      // biru tua & putih kebiruan
      "ungu-tua" => [
        'backgrounds' => ["#1F1B24"],
        'foregrounds' => ["#E0E0E0"]
      ],
      // ungu tua & abu terang
      "navy" => [
        'backgrounds' => ["#0A192F"],
        'foregrounds' => ["#64FFDA"]
      ],
      // navy & mint cerah
      "abu-gelap" => [
        'backgrounds' => ["#2D2A2E"],
        'foregrounds' => ["#F5B7B1"]
      ],
      // abu gelap & pink lembut
      "biru-abu" => [
        'backgrounds' => ["#1E2A3A"],
        'foregrounds' => ["#FFD966"]
      ],
      // biru abu & kuning keemasan
      "abu-tua" => [
        'backgrounds' => ["#2C2C2C"],
        'foregrounds' => ["#FF6F61"]
      ],
      // abu tua & merah karang
      "biru-malam" => [
        'backgrounds' => ["#2B2B52"],
        'foregrounds' => ["#FFEAA7"]
      ],
      // biru malam & krem
      "hijau-gelap" => [
        'backgrounds' => ["#1F2F2F"],
        'foregrounds' => ["#C7F9CC"]
      ],
      // hijau gelap & mint
      "ungu-pink" => [
        'backgrounds' => ["#4A1D3F"],
        'foregrounds' => ["#F8C7E5"]
      ],
      // ungu gelap & pink muda
      "hijau-kebiruan" => [
        'backgrounds' => ["#0B3B3F"],
        'foregrounds' => ["#E6E6FA"]
      ],
      // hijau kebiruan & lavender
      "hitam-emas" => [
        'backgrounds' => ["#1C1C1C"],
        'foregrounds' => ["#F4D03F"]
      ],
      // hitam & emas
      "abu-hijau" => [
        'backgrounds' => ["#232323"],
        'foregrounds' => ["#A9DFBF"]
      ],
      // abu tua & hijau pastel
      "ungu-oranye" => [
        'backgrounds' => ["#2E1A3C"],
        'foregrounds' => ["#FFB347"]
      ],
      // ungu gelap & oranye
      "biru-oranye" => [
        'backgrounds' => ["#003F5C"],
        'foregrounds' => ["#FFA600"]
      ] // biru tua & oranye terang
    ]
  ]
];