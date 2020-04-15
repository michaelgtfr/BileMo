<?php
// create with composer dump-env prod and add the dev configuration
// example dev configuration

return array (
  'APP_ENV' => 'dev',
  'APP_SECRET' => '****************',
  'DATABASE_URL' => '*********************',
  'PICTURE_SRC' => '/img/productsImg/',
  'MAILER_USER' => '*******************',
  'MAILER_URL' => 'null://localhost',
  'JWT_SECRET_KEY' => '%kernel.project_dir%/config/jwt/private.pem',
  'JWT_PUBLIC_KEY' => '%kernel.project_dir%/config/jwt/public.pem',
  'JWT_PASSPHRASE' => '************************',
  'REDIS_URL' => 'redis://localhost',
  'HOST_NELMIO' => 'localhost:8000/',
  'VERSION_SQL' => '***'
);

// example prod configuration

/*
return array (
  'APP_ENV' => 'prod',
  'APP_SECRET' => '***********************',
  'DATABASE_URL' => '*****************************************',
  'PICTURE_SRC' => '/img/productsImg/',
  'MAILER_USER' => '****************************',
  'MAILER_URL' => '*****************************',
  'JWT_SECRET_KEY' => '%kernel.project_dir%/config/jwt/private.pem',
  'JWT_PUBLIC_KEY' => '%kernel.project_dir%/config/jwt/public.pem',
  'JWT_PASSPHRASE' => '*****************************',
  'REDIS_URL' => '*************************',
  'HOST_NELMIO' => '*************',
  'VERSION_SQL' => '**********',
  'APP_DEBUG' => 1
);*/