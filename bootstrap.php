<?php
include_once __DIR__.'/vendor/autoload.php';

$classLoader = new \Composer\Autoload\ClassLoader();
$classLoader->addPsr4("", __DIR__.'/Domain', true);
$classLoader->addPsr4("", __DIR__.'/App', true);
$classLoader->register();