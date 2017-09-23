<?php
namespace tests;

use app\models\User;

require(__DIR__ . '/_bootstrap.php');

class TestCase
{
    protected function assert($condition, $message = '')
    {
        echo $message;

        if ($condition) {
            echo ' Ok' . PHP_EOL;
        } else {
            echo ' Fail' . PHP_EOL;
            exit();
        }
    }

    protected function assertTrue($condition, $message = '')
    {
        $this->assert($condition === true, $message);
    }

    protected function assertFalse($condition, $message = '')
    {
        $this->assert($condition === false, $message);
    }

    protected function assertArrayHasKey($key, $array, $message)
    {
        $this->assert(array_key_exists($key, $array), $message);
    }
}

class UserTest extends TestCase
{
    public function testValidateEmptyValues()
    {
        $user = new User();

        $this->assertFalse($user->validate(), 'model is not valid');
        $this->assertArrayHasKey('username', $user->getErrors(), 'check empty username error');
        $this->assertArrayHasKey('email', $user->getErrors(), 'check empty email error');
    }
}

$test = new UserTest();
$test->testValidateEmptyValues();