Testing with PHPUnit and Codeception
===============================
This repository only for learning testing.
You can find original links below:

All about testing tutorial:
http://www.elisdn.ru/blog/78/yii2-codeception-testing

Code of this testing tutorial:
https://github.com/ElisDN/webinar-tests

REQUIREMENTS
------------
1. PHP >= 5.4 with modules
2. SQLite

INSTALLATION
------------

1. Got to working directory:
```
cd path_to_working_directory
```

2. Install Yii2:
```
composer require yiisoft/yii2
```

RUN CUSTOM TESTS
----------------
Extend class from \tests\TestCase

Execute following for run test:
```
php test/app
```

Dealing with real data:
```
./yii migrate
```

Dealing with test data:
```
php tests/bin/yii migrate
```


Run PHPUnit Tests
------------------
1. Install phpunit:
```
composer require phpunit/phpunit
```

2. Add configuration file: phpunit.xml to project root
3. Extend test classes from \PHPUnit\Framework\TestCase
4. Execute command for run tests:
```
./vendor/bin/phpunit
```

Run PHPUnit Test through PHPStorm
---------------------------------
1. Set PHP interpreter in settings:
File->Settings->PHP and set need version.

2. Download phpunit.phar file

3. Set PHPUnit settings: File->Settings->PHP->PHPUnit
and choose Path to PHPUnit.phar and set it. Then choose phpunit.xml config for project.

4. Edit configuration-> + -> PHPUnit. Rename to Unit, set config file if need.

5. Choose Unit and click to green arrow.


DbUnit
----------
1. Install
```
composer require phpunit/dbunit
```

2. Extend Test class from PHPUnit\DbUnit\TestCase

3. Realize abstract methods:
```
    public function getConnection()
    {
        $pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
        return $this->createDefaultDBConnection($pdo, $GLOBALS['DB_DBNAME']);
    }

    public function getDataSet()
    {
        return $this->createXMLDataSet(dirname(__FILE__).'/../_data/users.xml');
    }
```


Code coverage
-------------
1. Add whitelist to phpunit.xml and add directory for checking code coverage
```
        <whitelist>
            <directory suffix=".php">./models</directory>
        </whitelist>
```

2. Execute command:
```
./vendor/bin/phpunit --coverage-html ./report
```

This command will generate report to directory ./report


Codeception
-----------
1. Prepare. Remove all new versions of phpunit and dbunit
```
composer remove phpunit/dbunit
composer remove phpunit/phpunit
composer require phpunit/phpunit:"~4.8"
composer require phpunit/dbunit:"~1.4"
```
In your composer.json file you should see:
```json
"phpunit/phpunit": "~4.8",
"phpunit/dbunit": "~1.4",
```

2. Installation
```
composer require "codeception/codeception=2.1.*"
composer require "codeception/specify=*"
composer require "codeception/verify=*"
```

3. Checking is codeception work
```
./vendor/bin/codecept
```
4. Delete ./test folder and ./phpunit.xml
5. Create configuration
```
./vendor/bin/codecept bootstrap
```
6. Copy ./tests/bin/yii from previous deleted version, add configuration
in ./tests/config directory

7. Generate UserTest:
```
./vendor/bin/codecept generate:test unit UserTest
```
8. Copy non DbUnit methods from previous UserTest class.
9. Build
```
./vendor/bin/codecept build
```
10. Run it
```
./vendor/bin/codecept run
./vendor/bin/codecept run unit
```

11. Add Db module
    - Add Db module to codeception.yml
    - Add Db to unit.suit.yml
    - add SQL to tests/d_data/dump.sql
    - delete Db changing in _before()
    
See commit: 18371e765242d80766ab15633fa3eee63ce8dcc6