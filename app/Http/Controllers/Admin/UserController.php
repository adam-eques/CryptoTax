<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccountType;
use Illuminate\Http\Request;

abstract class UserController extends Controller
{
    protected string $routeSlug;
    protected string $label;
    protected string $labelPlural;

    public function index()
    {
        return view('pages.admin.users.index', [
            "account_type_ids" => $this->getAccountTypeIds(),
            "label" => $this->label,
            "labelPlural" => $this->labelPlural,
        ]);
    }

    //public function create()
    //{
    //    //
    //}

    //public function store(Request $request)
    //{
    //    //
    //}

    //public function show($id)
    //{
    //    //
    //}

    public function edit(User $user)
    {
        return view('pages.admin.users.edit', [
            "user" => $user,
            "label" => $this->label,
            "labelPlural" => $this->labelPlural,
        ]);
    }

    //public function update(Request $request, $id)
    //{
    //    //
    //}

    //public function destroy($id)
    //{
    //    //
    //}

    abstract protected function getAccountTypeIds(): array;
}
