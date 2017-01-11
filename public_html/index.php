<?php
/* All file paths relative to root */
chdir(dirname(__DIR__));

/* SYSTEM */
define('APP_ROOT', 'SlimAAC');
define('ENABLE_DEBUG', false);
define('TFS_ROOT', '../server');
define('TFS_CONFIG', TFS_ROOT . '/config.lua');
define('ROUTES_PREFIX', '/api/v1');
define('CORS_ALLOW_ORIGIN', 'http://localhost:8080');
define('ACCOUNT_RECOVERY_INTERVAL', 10800);
define('PUBLIC_HTML_PATH', realpath('./public_html'));
define('HAS_APC', extension_loaded('apc') && ini_get('apc.enabled'));

/* GAME */
define('ACCOUNT_TYPE_GOD', 5);
define('ACCOUNT_TYPE_GAMEMASTER', 4);
define('ACCOUNT_TYPE_SENIORTUTOR', 3);
define('ACCOUNT_TYPE_TUTOR', 2);

/* PLAYERS */
define('ALLOWED_VOCATIONS', serialize(array(1, 2, 3, 4)));
define('NEW_PLAYER_LEVEL', 0);
define('NEW_PLAYER_TOWN_ID', 1);

/* HOUSES */
define('HOUSES_AUCTIONS', true);
define('HOUSES_AUCTION_TIME', 'P7D'); // DateInterval spec notation: http://www.php.net/manual/en/dateinterval.construct.php
define('HOUSES_PER_PLAYER', 1);
define('HOUSES_PER_ACCOUNT', 1);
define('HOUSES_BID_RAISE', 1000);
define('HOUSES_BID_RAISE_PERCENT', 0);

require 'bootstrap/app.php';
$app->run();
