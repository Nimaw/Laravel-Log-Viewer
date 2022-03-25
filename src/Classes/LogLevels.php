<?php

namespace Nimaw\Logviewer\Classes;

class LogLevels
{
    /**
     * @var array
     */
    const levels = [
        'debug' => 'info',
        'info' => 'info',
        'notice' => 'info',
        'warning' => 'warning',
        'error' => 'danger',
        'critical' => 'danger',
        'alert' => 'danger',
        'emergency' => 'danger',
        'processed' => 'info',
        'failed' => 'warning',
    ];

    /**
     * @return array
     */
    public static function all()
    {
        return array_keys(self::levels);
    }
}
