<?php

ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Moscow');

require_once 'functions.php';

$rootDir = realpath(dirname(dirname(__FILE__)));

define('DS', DIRECTORY_SEPARATOR);
define('LIBS', $rootDir . DS . 'libs');
define('HTDOCS', $rootDir . DS . 'htdocs');

define('APP', $rootDir . DS . 'application');
define('CORE', $rootDir . DS . 'application' . DS . 'classes');
define('MODULES', $rootDir . DS . 'application' . DS . 'modules');


require_once LIBS .DS . 'Base' . DS . 'Autoloader.php';
\Base\Autoloader::register();

\Base\Autoloader::registerDirectory(LIBS);
\Base\Autoloader::registerDirectory(CORE);
\Base\Autoloader::registerDirectory(MODULES);

\Base\Config::setDirectory(APP . DS . 'configs');