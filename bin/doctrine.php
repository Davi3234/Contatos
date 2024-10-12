<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Src\Config\EntityManagerCreator;

// Adjust this path to your actual bootstrap.php
require __DIR__ . '/../vendor/autoload.php';

$entityManager = EntityManagerCreator::getInstance()->getEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);