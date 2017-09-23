<?php
namespace tests;

use app\models\User;

require(__DIR__ . '/_bootstrap.php');

$user = new User();

$user->username = 'Daniar';
$user->email = 'daniar@mail.ru';

print_r($user->getAttributes());