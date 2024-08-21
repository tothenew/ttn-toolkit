<?php

$settings['redis.connection']['timeout'] = 2.5;
ini_set("default_socket_timeout", -1);

$settings['hash_salt'] = 'my-salt';
$settings['update_free_access'] = FALSE;
$settings['http_client_config']['timeout'] = 300;
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];
$settings['entity_update_batch_size'] = 50;
$settings['entity_update_backup'] = TRUE;
$settings['migrate_node_migrate_type_classic'] = FALSE;

$config['config_split.config_split.development']['status'] = TRUE;

$settings['config_sync_directory'] = 'config/sync';

$databases['default']['default'] = array (
  'database' => '<app-database-name>',
  'username' => '<database-username>',
  'password' => '<database-password>',
  'prefix' => '',
  'host' => '<database-host>',
  'port' => '<database-port>',
  'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
  'driver' => 'mysql',
  'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
);

$settings['doctors_api_url'] = "doctors_api_url_value";
$settings['hospitals_api_url'] = "hospitals_api_url_value";
$settings['specialities_api_url'] = "specialities_api_url_value";
$settings['env_id'] = "env_id_value";

// Redis settings.
$settings['redis.connection']['interface'] = 'PhpRedis';
$settings['redis.connection']['host'] = '<redis_host>';
$settings['redis.connection']['password'] = "<redis_password>";
$settings['redis.connection']['port'] = '<redis_port>';
$settings['cache']['default'] = 'cache.backend.redis';
$settings['redis.connection']['persistent'] = TRUE;
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/default/redis.services.yml';
$config['config_split.config_split.local_split']['status'] = FALSE;
$config['config_split.config_split.dev_split']['status'] = FALSE;
$config['config_split.config_split.qa_split']['status'] = FALSE;
$config['config_split.config_split.uat_split']['status'] = FALSE;
$config['config_split.config_split.prod_split']['status'] = FALSE;
$config['config_split.config_split.env_id_value_split']['status'] = TRUE;

$settings['SSL'] = "1";

// $config['config_split.config_split.development']['status'] = TRUE;
global $base_url;
// Added base_url to fix the redirect issue.
$base_url = 'drupal_base_url';

