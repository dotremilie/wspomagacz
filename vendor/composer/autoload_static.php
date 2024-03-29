<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2387dc757f95010fe6c33fd46adb72b0
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wspomagacz\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wspomagacz\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2387dc757f95010fe6c33fd46adb72b0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2387dc757f95010fe6c33fd46adb72b0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2387dc757f95010fe6c33fd46adb72b0::$classMap;

        }, null, ClassLoader::class);
    }
}
