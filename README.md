# Miko test

##### 1. Installation
###### 1.1 Prerequisites
I used composer to install the phpunit dependency, so if you want the working app you should have a composer.phar file available (you can get one at https://getcomposer.org/download/)

move to the root of he project and 
```
composer install
```
(note I assume you have PHP >=5.3)

#### 2. Usage
to run the application simply run 
```
php export_payment_dates.php
```

#### 3. Running tests
You can run the whole testsuite with 
```
vendor/bin/phpunit -c . --testdox
```

I named my test so that running test with the --testdox flag provides best output.