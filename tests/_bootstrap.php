<?php
// This is global bootstrap for autoloading

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

//set alias for tests directory
Yii::setAlias('@tests', dirname(__DIR__) . '/tests');