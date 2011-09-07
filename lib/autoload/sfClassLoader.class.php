<?php

require_once __DIR__.'/../vendor/ClassLoader/UniversalClassLoader.php';
require_once __DIR__.'/../vendor/ClassLoader/ApcUniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Symfony\Component\ClassLoader\ApcUniversalClassLoader;

class sfClassLoader
{

    /**
     *
     * @var UniversalClassLoader
     */
    static protected $loader = null;

    /**
     *
     * @param bool $cache
     * @param string $prefix
     */
    static public function initialise($cache = false, $prefix = 'sfClassLoader.')
    {
        if (self::$loader) {
            return;
        }

        if ($cache) {
            self::$loader = new ApcUniversalClassLoader($prefix);
        }
        else {
            self::$loader = new UniversalClassLoader();
        }

        sfCoreAutoload::register();
        self::$loader->register();
    }

    /**
     *
     * @return UniversalClassLoader
     */
    static public function getLoader()
    {
        if (!self::$loader) {
            throw new \RuntimeException('sfClassLoader has not been initialised.');
        }

        return self::$loader;
    }

}