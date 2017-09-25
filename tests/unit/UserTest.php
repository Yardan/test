<?php
namespace tests\unit;

use app\models\User;

class UserTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        User::deleteAll();
        \Yii::$app->db->createCommand()->insert(User::tableName(), [
            'username' => 'user',
            'email' => 'user@mail.ru',
        ])->execute();
    }

    protected function _after()
    {
    }

    public function testValidateExistedValues()
    {
        $user = new User([
            'username' => 'user',
            'email' => 'user@mail.ru',
        ]);
        $this->assertFalse($user->validate(), 'model is not valid');
        $this->assertArrayHasKey('username', $user->getErrors(), 'check existed username error');
        $this->assertArrayHasKey('email', $user->getErrors(), 'check existed email error');
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