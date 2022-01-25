<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccountTypeMiddleware
{
    public function handle(Request $request, Closure $next, $typeSlug)
    {
        $types = [
            "admin" => "isAdminAccount",
            "customer" => "isCustomerAccount",
            "tax-advisor" => "isTaxAdvisorAccount",
            "support" => "isSupportAccount",
            "editor" => "isEditorAccount",
        ];
        $method = $types[$typeSlug];


        if(!$request->user() || !$request->user()->$method()) {
            abort(403);
        }

        return $next($request);
    }
}
