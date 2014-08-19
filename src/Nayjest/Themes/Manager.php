<?php
namespace Nayjest\Themes;

use App;
use Config;
use Nayjest\Common\Meta;
use Nayjest\Common\Singleton;

class Manager
{
    use Singleton;

    /**
     * @var FileViewFinder
     */
    protected $finder;

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    protected function __construct()
    {
        $this->finder = App::make('view.finder');
        $this->files = App::make('files');
    }

    /**
     * @param $theme
     */
    public function apply($theme)
    {
        $this->applyForAppViews($theme);
        $this->applyForAllPackages($theme);
    }

    public function applyCurrent()
    {
        $this->apply($this->current());
    }

    public function applyAll()
    {
        array_map([$this, 'apply'], $this->activeThemes());
    }

    public function applyForAppViews($theme)
    {
        $path = $this->path($theme);
        if ($this->files->isDirectory($path)) {
            $this->finder->addLocation($path, true);
        }
    }

    public function applyForAllPackages($theme)
    {
        $this->applyForPackages($theme, Meta::instance()->allPackages());
    }

    public function applyForPackages($theme, $packages)
    {
        foreach($packages as $package) {
            $this->applyForPackage($theme, $package);
        }
    }

    /**
     * @todo @performance implement namespace hints instead!! see how it done in Illuminate\Support\ServiceProvider
     * @param $theme
     * @param $package
     */
    public function applyForPackage($theme, $package)
    {
        $parts = explode('/', $package);
        $namespace = $parts[1];

        $path = $this->packageViewsPath($theme, $package);
        if ($this->files->isDirectory($path)) {
            //$this->finder->addLocation($path, true);
            $this->finder->addNamespace($namespace, $path, true);
        }
    }

    public function themesPath()
    {
        return Config::get('themes::base_path', app_path('views'));
    }

    public function folderPrefix()
    {
        return Config::get('themes::folder_prefix', '');
    }

    /**
     * @return string Theme name
     */
    public function current()
    {
        return Config::get('themes::theme', 'default');
    }

    /**
     * @return array
     */
    public function fallback()
    {
        return Config::get('themes::fallback', []);
    }

    /**
     * @return string[] theme names sorted by priority ascending
     */
    public function activeThemes()
    {
        $themes = array_reverse($this->fallback());
        $themes[] = $this->current();
        return $themes;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return Config::get('themes::enabled', false);
    }

    public function path($theme)
    {
        $themes_path = $this->themesPath();
        $folder_prefix = $this->folderPrefix();
        return "{$themes_path}/{$folder_prefix}{$theme}";
    }

    public function packageViewsPath($theme, $package)
    {
        $path = $this->path($theme);
        return "$path/packages/$package";
    }

}