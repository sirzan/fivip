<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbb4bc1cc4ad174fea6b8bdf274cd7e76
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mike42\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mike42\\' => 
        array (
            0 => __DIR__ . '/..' . '/mike42/escpos-php/src/Mike42',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbb4bc1cc4ad174fea6b8bdf274cd7e76::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbb4bc1cc4ad174fea6b8bdf274cd7e76::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbb4bc1cc4ad174fea6b8bdf274cd7e76::$classMap;

        }, null, ClassLoader::class);
    }
}
