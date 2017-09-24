Testing with PHPUnit and Codeception
===============================

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