<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitad8efb285afeed60ca3359fe5ea33440
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitad8efb285afeed60ca3359fe5ea33440::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitad8efb285afeed60ca3359fe5ea33440::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitad8efb285afeed60ca3359fe5ea33440::$classMap;

        }, null, ClassLoader::class);
    }
}
