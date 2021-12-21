<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DevController extends Controller
{
    public function index()
    {
        return view("pages.admin.dev.index");
    }


    public function icons()
    {
        return view("pages.admin.dev.icons", [
            "icons" => array_filter(\File::allFiles(resource_path("svg")), function ($item) {
                return strpos($item, '.svg');
            })
        ]);
    }
}
