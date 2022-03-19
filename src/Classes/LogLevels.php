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
     * @var array
     */
    private $levels_imgs = [
        'debug' => 'info-circle',
        'info' => 'info-circle',
        'notice' => 'info-circle',
        'warning' => 'exclamation-triangle',
        'error' => 'exclamation-triangle',
        'critical' => 'exclamation-triangle',
        'alert' => 'exclamation-triangle',
        'emergency' => 'exclamation-triangle',
        'processed' => 'info-circle',
        'failed' => 'exclamation-triangle'
    ];

    /**
     * @return array
     */
    public static function all()
    {
        return array_keys(self::levels);
    }

    /**
     * @param $level
     * @return string
     */
    public function img($level)
    {
        return $this->levels_imgs[$level];
    }

    /**
     * @param $level
     * @return string
     */
    public function cssClass($level)
    {
        return $this->levels_classes[$level];
    }
}
