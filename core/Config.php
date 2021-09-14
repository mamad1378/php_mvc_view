<?php

namespace Core;

class Config
{
    public static function get(string $key): mixed
    {
        $configs = include "./app/config.php";
        if (array_key_exists($key, $configs)) {
            return $configs[$key];
        }
        return null;
    }
}
