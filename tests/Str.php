<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Zongrzhang\Tools\Str;
use Zongrzhang\Tools\Arr;

$arr = [
    'a' => ' aa ',
    'b' => ' bb',
    'c' => 'c ',
    'd' => [
        'a1' => ' a1',
        'b' => 'b',
        'c' => 12
    ],
];

$arr = Str::trim($arr);

//var_dump($arr);

$arr = [
    ['a' => 'a1', 'b' => 'b1', 'c' => 'c1'],
    ['a' => 'a2', 'b' => 'b2', 'c' => 'c2'],
    ['a' => 'a3', 'b' => 'b3', 'c' => 'c3'],
    ['a' => 'a4', 'b' => 'b4', 'c' => 'c4'],
    ['a' => 'a5', 'b' => 'b5', 'c' => 'c5'],
];

$arr1 = Arr::column($arr);
//var_dump($arr1);
//$arr1 = Arr::column($arr, null, 'a');
//var_dump($arr1);
//$arr1 = Arr::column($arr, 'a');
//var_dump($arr1);

//$arr1 = Arr::column($arr, 'a', 'a');
//var_dump($arr1);

//$arr1 = Arr::column($arr, 'a,b', 'a');
//var_dump($arr1);

$arr1 = Arr::column($arr, 'a,c');
var_dump($arr1);