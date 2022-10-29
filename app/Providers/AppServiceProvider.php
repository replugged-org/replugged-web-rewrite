<?php

namespace App\Providers;

use Feather\IconManager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('icons', function () {
            return new IconManager();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceRootUrl(env('APP_URL'));
        URL::forceScheme('https');

        // Hack to give Blade files access to their own pre-compilation paths
        // and filenames.
        Blade::extend(function ($view, $compiler) {
            $path = $compiler->getPath();
            $res_path = resource_path('views') . '/';
            $name = str_replace($res_path, '', $path);
            preg_match('/([^\/]+$)/', $name, $arr);
            $pathto = str_replace("/{$arr[0]}", '', $path);
            $view = "<?php \$__META_PATH = '{$path}';\n\$__META_PATHTO = '{$pathto}';\n\$__META_FILENAME = '{$arr[0]}'; ?>\n{$view}";
            return $view;
        });
    }
}
