<?php
namespace App\Helpers;


use Illuminate\Support\Facades\Storage;
class TestHelper {
    public static function save2file($path, $var) {
        $flag = env('APP_HELPER_TRACE', false);
        $ret = false;
        if ($flag) {
            $ret = Storage::put('test/'.$path.'.json', json_encode($var));
        }
        return $ret;
    }
}