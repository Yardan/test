<?php
namespace tests;

use app\models\User;

require(__DIR__ . '/_bootstrap.php');


class UserTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        User::deleteAll([
            'username' => 'TestUsername',
            'email' => 'test@mail.ru',
        ]);
    }

    public function testSaveIntoDatabase()
    {
        $user = new User([
            'username' => 'TestUsername',
            'email' => 'test@mail.ru',
        ]);

        $this->assertTrue($user->save(), 'model is saved');
    }

    public function testValidateEmptyValues()
    {
        $user = new User();

        $this->assertFalse($user->validate(), 'model is not valid');
        $this->assertArrayHasKey('username', $user->getErrors(), 'check empty username error');
        $this->assertArrayHasKey('email', $user->getErrors(), 'check empty email error');
    }

    public function testValidateWrongValues()
    {
        $user = new User([
            'username' => 'Wrong % Username',
            'email' => 'wrong_email',
        ]);

        $this->assertFalse($user->validate(), 'validate incorrect username and email');
        $this->assertArrayHasKey('username', $user->getErrors(), 'check incorrect username error');
        $this->assertArrayHasKey('email', $user->getErrors(), 'check incorrect email error');
    }

    public function testValidateCorrectValues()
    {
        $user = new User([
            'username' => 'CorrectUsername',
            'email' => 'correct@mail.ru',
        ]);

        $this->assertTrue($user->validate(), 'correct model is valid');
    }

}

$class = new \ReflectionClass('\tests\UserTest');

foreach ($class->getMethods() as $method) {
    if (substr($method->name, 0, 4) == 'test') {
        echo 'Test ' . $method->class . '::' . $method->name . PHP_EOL . PHP_EOL;

        /**
         * @var TestCase $test
         */
        $test = new $method->class;
        $test->setUp();
        $test->{$method->name}();
        $test->tearDown();
        echo PHP_EOL;
    }
}