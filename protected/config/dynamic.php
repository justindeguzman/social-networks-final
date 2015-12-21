<?php return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'yii\\db\\Connection',
      'dsn' => 'mysql:host=127.0.0.1;dbname=humhub',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
    ),
    'user' => 
    array (
    ),
    'mailer' => 
    array (
      'transport' => 
      array (
        'class' => 'Swift_MailTransport',
      ),
      'view' => 
      array (
        'theme' => 
        array (
          'name' => 'HumHub',
        ),
      ),
    ),
    'view' => 
    array (
      'theme' => 
      array (
        'name' => 'HumHub',
      ),
    ),
    'formatter' => 
    array (
      'defaultTimeZone' => 'America/New_York',
    ),
    'formatterApp' => 
    array (
      'defaultTimeZone' => 'America/New_York',
      'timeZone' => 'America/New_York',
    ),
  ),
  'params' => 
  array (
    'installer' => 
    array (
      'db' => 
      array (
        'installer_hostname' => '127.0.0.1',
        'installer_database' => 'humhub',
      ),
    ),
    'config_created_at' => 1447024496,
    'installed' => true,
  ),
  'name' => 'Social.mesh',
  'language' => 'en-US',
  'timeZone' => 'America/New_York',
); ?>