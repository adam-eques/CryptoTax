<?php

namespace App\Resources;

use Illuminate\Support\Facades\Route;
use ReflectionClass;

abstract class Resource
{
    public static $routePrefix = "admin";
    protected string $model;
    protected string $icon = "fas-file";


    public static function make(): static
    {
        return new static();
    }


    public static function routes($only = []): void
    {
        $obj = new static();
        $name = $obj->modelKebabCase();
        #$class = "\\App\\Http\\Controllers\\" . $obj->getResourceShortName() . "Controller";
        $class = "\\App\\Http\\Controllers\\Admin\\ResourceController";

        Route::resource($name, $class)->parameters([
            $name => 'modelId',
        ])->only($only ? $only : [
            "index",
            "create",
            "edit",
        ]);
    }


    public static function makeByModel($model): ?self
    {
        $reflect = new ReflectionClass($model);
        $class = "\\App\\Resources\\".$reflect->getShortName()."Resource";

        return $class ? ($class)::make() : null;
    }


    public function label(): string
    {
        return __(\Str::singular($this->getResourceShortName()));
    }


    public function labelPlural(): string
    {
        return __(\Str::plural($this->label()));
    }


    public function icon(): string
    {
        return $this->icon;
    }


    public function model(): string
    {
        return $this->model ?? "\\App\\Models\\".$this->getResourceShortName();
    }


    public function modelCamelCase(): string
    {
        return \Str::camel(
            \Str::plural($this->getResourceShortName())
        );
    }


    public function modelKebabCase(): string
    {
        return \Str::kebab($this->getResourceShortName());
    }


    public function getRoute(string $action = "index", $params = []): string
    {
        return route($this->getRouteName($action), $params);
    }


    public function getRouteName(string $action = "index"): string
    {
        return static::$routePrefix.".".$this->modelKebabCase().".".$action;
    }


    public function livewire(string $component)
    {
        return "admin.".$this->modelKebabCase().'-'.$component;
    }


    public function sidebar(?string $label = null, ?string $icon = null): array
    {
        return [
            "label" => is_string($label) ? $label : $this->labelPlural(),
            "icon" => is_string($icon) ? $icon : $this->icon(),
            "route" => $this->getRouteName(),
        ];
    }


    protected function getResourceShortName(): string
    {
        $reflect = new ReflectionClass($this);

        return preg_replace('/Resource$/', '', $reflect->getShortName());
    }
}
