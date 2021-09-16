<?php

namespace Zongrzhang\Tools;

class Json
{
    /**
     * 转化为json格式，并格式化样式
     * @param $data
     * @return false|string
     */
    public static function prettyPrint($data)
    {
        if (self::isJson($data)) {
            $data = json_decode($data, true);
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * 判断是否是json
     * @param $str
     * @return bool
     */
    public static function isJson($str)
    {
        json_decode($str);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * decode
     * @param $data
     * @param bool $assoc
     * @return mixed
     */
    public static function decode($data, $assoc = true)
    {
        if (!self::isJson($data)) {
            return $data;
        }
        return json_decode($data, $assoc);
    }

    /**
     * encode
     * @param $data
     * @param int $options
     * @return false|string
     */
    public static function encode($data, $options = JSON_UNESCAPED_UNICODE)
    {
        return json_encode($data, $options);
    }
}