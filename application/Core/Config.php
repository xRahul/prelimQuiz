<?php

namespace App\Core;

class Config {
    private static $config;

    public static function get($key)
    {
        // Check environment variables first (prioritize env vars over config files)
        // We check $_ENV and getenv()
        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }

        $env = getenv($key);
        if ($env !== false) {
            return $env;
        }

        // Lazy load config file
        if (!self::$config) {
            $config_file = dirname(__DIR__) . '/config/config.php';
            $config_dev_file = dirname(__DIR__) . '/config/config.development.php';

            if (file_exists($config_file)) {
                self::$config = require $config_file;
            } elseif (file_exists($config_dev_file)) {
                self::$config = require $config_dev_file;
            } else {
                // If no config file, we rely purely on env vars or defaults
                self::$config = [];
            }
        }

        return isset(self::$config[$key]) ? self::$config[$key] : null;
    }
}
