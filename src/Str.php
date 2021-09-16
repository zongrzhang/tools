<?php

namespace Zongrzhang\Tools;

class Str
{
    /**
     * 重写trim
     * @param mixed $data
     * @return mixed|string
     */
    public static function trim($data)
    {
        if (!is_array($data)) {
            return is_string($data) ? trim($data) : $data;
        }

        foreach ($data as &$da) {
            if (is_array($da)) {
                $da = self::trim($da);
            } elseif (is_string($da)) {
                $da = trim($da);
            }
        }

        return $data;
    }
}