<?php

// start session
session_start();

require_once 'config.php';

// helpers
require_once 'helpers/system_helper.php';

// auto load classes
function __autoload($class_name) {
    require_once 'lib/' . $class_name . '.php';
}