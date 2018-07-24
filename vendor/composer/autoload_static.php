<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd825d4ae318e8199350ffc51bf07a368
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd825d4ae318e8199350ffc51bf07a368::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd825d4ae318e8199350ffc51bf07a368::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}