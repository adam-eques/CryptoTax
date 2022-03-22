<?php
namespace App\Helpers;

class TestHelper {
    public static function save2file($path, $var) {
        $flag = env('APP_HELPER_TRACE', false);
        if ($flag) {
            $var_str = var_export($var, true);
            $var = "<?php\n\n\$text = $var_str;\n\n?>";
            file_put_contents($path, $var);
        }
    }
}