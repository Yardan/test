<?php
namespace tests\unit;

use app\models\User;
use Codeception\Specify;

class UserTest extends \Codeception\TestCase\Test
{
    use Specify;
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $user;

    protected function _before()
    {
        $this->user = new User();
    }

    protected function _after()
    {
    }

    public function testValidation()
    {
        $this->specify('fields are required', function () {
            $this->user->username = null;
            $this->user->email = null;
            expect('model is not valid', $this->user->validate())->false();
            expect('username has error', $this->user->getErrors())->hasKey('username');
            expect('email has error', $this->user->getErrors())->hasKey('email');
        });

        $this->specify('fields are wrong', function () {
            $this->user->username = 'Wrong % Username';
            $this->user->email = 'wrong_email';
            expect('model is not valid', $this->user->validate())->false();
            expect('username has error', $this->user->getErrors())->hasKey('username');
            expect('email has error', $this->user->getErrors())->hasKey('email');
        });

        $this->specify('fields are unique', function () {
            $this->user->username = 'user';
            $this->user->email = 'user@mail.ru';
            expect('model is not valid', $this->user->validate())->false();
            expect('username has error', $this->user->getErrors())->hasKey('username');
            expect('email has error', $this->user->getErrors())->hasKey('email');
        });

        $this->specify('fields are correct', function () {
            $this->user->username = 'CorrectUsername';
            $this->user->email = 'correct@mail.ru';
            expect('model is valid', $this->user->validate())->true();
        });


    }

    public function testSaveIntoDatabase()
    {
        $user = new User([
            'username' => 'TestUsername',
            'email' => 'test@mail.ru',
        ]);

        expect('model is saved', $user->save())->true();
    }
}