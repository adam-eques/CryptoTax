<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\Resources\Resource;
use Illuminate\Database\Eloquent\Model;

class ResourceController extends Controller
{
    protected string $resourceClass;
    protected Resource $resource;


    public function callAction($method, $parameters)
    {
        $shortName = $this->getResourceNameShort();
        $this->resource = Resource::makeByShortName($shortName);
        $this->resourceClass = ($this->resource)::class;

        return parent::callAction($method, $parameters);
    }


    public function index()
    {
        return view("pages.admin.resources.index", $this->getViewVariables());
    }


    public function create()
    {
        return view("pages.admin.resources.form", $this->getViewVariables([
            "model" => new ($this->resource->model())(),
        ]));
    }


    public function edit($modelId)
    {
        return view("pages.admin.resources.form", $this->getViewVariables([
            "model" => $this->findModel($modelId),
        ]));
    }


    protected function findModel(string|int $modelId): Model
    {
        return ($this->resource->model())::findOrFail($modelId);
    }


    protected function getViewVariables(array $merge = []): array
    {
        return array_merge([
            "resource" => $this->resource,
            "resourceClass" => $this->resourceClass,
        ], $merge);
    }


    protected function getResourceNameShort(): string
    {
        $path = request()->route()->uri();
        $parts = explode("/", $path);

        return Resource::$routePrefix ? $parts[1] : $parts[0];
    }
}
