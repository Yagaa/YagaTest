<?php
require 'Router.php';
define("CONF_PATH", __DIR__."/Conf");
define("MODEL_PATH", __DIR__."/Model");
define("API_PATH", __DIR__."/Api");

$Api = new Router();
$Api->init();

