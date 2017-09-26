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
        expect('model is not valid', $user->validate())->false();
        expect('check existed username error', $user->getErrors())->hasKey('username');
        expect('check existed email error', $user->getErrors())->hasKey('email');
    }
    public function testSaveIntoDatabase()
    {
        $user = new User([
            'username' => 'TestUsername',
            'email' => 'test@mail.ru',
        ]);

        expect('model is saved', $user->save())->true();
    }
    public function testValidateEmptyValues()
    {
        $user = new User();
        expect('model is not valid', $user->validate())->false();
        expect('check empty username error', $user->getErrors())->hasKey('username');
        expect('check empty email error', $user->getErrors())->hasKey('email');
    }
    public function testValidateWrongValues()
    {
        $user = new User([
            'username' => 'Wrong % Username',
            'email' => 'wrong_email',
        ]);

        expect('validate incorrect username and email', $user->validate())->false();
        expect('check incorrect username error', $user->getErrors())->hasKey('username');
        expect('check incorrect email error', $user->getErrors())->hasKey('email');
    }

    public function testValidateCorrectValues()
    {
        $user = new User([
            'username' => 'CorrectUsername',
            'email' => 'correct@mail.ru',
        ]);
        expect('correct model is valid', $user->validate())->true();
    }
}