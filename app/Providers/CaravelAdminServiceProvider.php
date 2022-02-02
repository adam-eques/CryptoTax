<?php

namespace App\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;
use Livewire\Livewire;
use ReflectionClass;
use Str;
use Symfony\Component\Finder\SplFileInfo;

class CaravelAdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerLivewireComponentDirectory(config("caravel-admin.resources.path"), config("caravel-admin.resources.namespace"), config("caravel-admin.resources.prefix"));
    }


    /**
     * Taken from filamentadmin (/src/FilamentServiceProvider.php)
     *
     * @param string $directory
     * @param string $namespace
     * @param string $aliasPrefix
     * @return void
     */
    protected function registerLivewireComponentDirectory(string $directory, string $namespace, string $aliasPrefix = ''): void
    {
        $filesystem = app(Filesystem::class);

        if (! $filesystem->isDirectory($directory)) {
            return;
        }

        collect($filesystem->allFiles($directory))
            ->map(function (SplFileInfo $file) use ($namespace): string {
                return (string) Str::of($namespace)
                    ->append('\\', $file->getRelativePathname())
                    ->replace(['/', '.php'], ['\\', '']);
            })
            ->filter(fn (string $class): bool => is_subclass_of($class, Component::class) && (! (new ReflectionClass($class))->isAbstract()))
            ->each(function (string $class) use ($namespace, $aliasPrefix): void {
                $alias = Str::of($class)
                    ->after($namespace . '\\')
                    ->replace(['/', '\\'], '.')
                    ->prepend($aliasPrefix)
                    ->explode('.')
                    ->map([Str::class, 'kebab'])
                    ->implode('.');

                Livewire::component($alias, $class);
            });
    }
}
