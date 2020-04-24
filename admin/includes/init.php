<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT', DS.'Users' . DS . 'kevinschroeder' . DS . '.bitnami' . DS . 'stackman' . DS . 'machines' . DS . 'xampp' . DS . 'volumes' . DS . 'root' . DS . 'htdocs' . DS . 'gallery');

define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

require_once('new_config.php');
require_once('database.php');
require_once('db_object.php');
require_once('user.php');
require_once(__DIR__ . DS . 'photo.php');
require_once('functions.php');
require_once('session.php');
require_once('comment.php');



?>