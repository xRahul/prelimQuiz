<?php

use App\Core\Application;
use Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

// Load .env if exists
$dotenvPath = dirname(__DIR__);
if (file_exists($dotenvPath . '/.env')) {
    $dotenv = Dotenv::createImmutable($dotenvPath);
    $dotenv->load();
}

$application = new Application();
