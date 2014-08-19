<?php
namespace Nayjest\Themes;

use Illuminate\View\FileViewFinder as Base;

class FileViewFinder extends Base {

    /**
     * @param string $location
     * @param bool $high_priority
     */
    public function addLocation($location, $high_priority = false)
    {
        if ($high_priority) {
            array_unshift($this->paths, $location);
        } else {
            parent::addLocation($location);
        }
    }

    /**
     * Add a namespace hint to the finder.
     *
     * @param  string  $namespace
     * @param  string|array  $hints
     * @return void
     */
    public function addNamespace($namespace, $hints, $high_priority = false)
    {
        $hints = (array) $hints;

        if (isset($this->hints[$namespace]))
        {
            if ($high_priority) $hints = array_merge($hints, $this->hints[$namespace]);
            else $hints = array_merge($this->hints[$namespace], $hints);
        }

        $this->hints[$namespace] = $hints;
    }

} 