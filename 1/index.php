<?php
require 'vendor/autoload.php';
$config = require __DIR__ . '/app/config/bd.php';

use Ozycast\App\App;

$app = new App($config);
echo $app->run();