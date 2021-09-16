<?php

namespace Zongrzhang\Tools;

class Arr
{
    /**
     * column
     * @param $data
     * @param string|null $column
     * @param string|null $index
     * @return array|mixed
     */
    public static function column($data, $column = null, $index = null)
    {
        if (is_null($column) && is_null($index)) {
            return $data;
        }

        if (strpos($column, ',') === false) {
            return array_column($data, $column, $index);
        }

        // 多列
        $columns = explode(',', $column);
        $keys = [];
        if ($index) {
            $keys = array_column($data, $index);
        }

        $arr = [];
        foreach ($data as $key => $da) {
            if (is_array($da)) {
                foreach ($da as $idx => $val) {
                    if (!in_array($idx, $columns)) {
                        unset($da[$idx]);
                    }
                }
            }

            if (isset($keys[$key])) {
                $arr[$keys[$key]] = $da;
            } else {
                $arr[] = $da;
            }
        }

        return $arr;
    }
}