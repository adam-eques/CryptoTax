<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class TestHelper
{
    public static function save2file(string $path, mixed $var)
    {
        $flag = config("app.helper.trace");
        $ret = false;
        if ($flag) {
            $ret = Storage::put('test/'.$path.'.json', json_encode($var));
        }

        return $ret;
    }
}
