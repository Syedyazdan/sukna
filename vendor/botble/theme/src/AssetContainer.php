<?php

namespace Botble\Theme;

use Exception;
use File;
use Illuminate\Support\Arr;
use Theme as ThemeFacade;

class AssetContainer
{
    /**
     * Use a theme path.
     *
     * @var boolean
     */
    protected $usePath = false;

    /**
     * Path to theme.
     *
     * @var string
     */
    protected $path;

    /**
     * The asset container name.
     *
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $assets = [];

    /**
     * Create a new asset container instance.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Root asset path.
     *
     * @param string|null $uri
     * @return string
     */
    public function originUrl(?string $uri): string
    {
        return $this->configAssetUrl($uri);
    }

    /**
     * Generate a URL to an application asset.
     *
     * @param string|null $path
     * @return string
     */
    protected function configAssetUrl(?string $path): string
    {
        return asset($path);
    }

    /**
     * Return asset path with current theme path.
     *
     * @param string|null $uri
     * @return string
     */
    public function url(?string $uri): string
    {
        // If path is full, so we just return.
        if (preg_match('#^http|//:#', $uri)) {
            return $uri;
        }

        $path = $this->getCurrentPath() . $uri;

        return $this->configAssetUrl($path);
    }

    /**
     * Get path from asset.
     *
     * @return string
     */
    public function getCurrentPath(): string
    {
        return Asset::$path;
    }

    /**
     * Add an asset to the container.
     *
     * The extension of the asset source will be used to determine the type of
     * asset being registered (CSS or JavaScript). When using a non-standard
     * extension, the style/script methods may be used to register assets.
     *
     * <code>
     *      // Add an asset to the container
     *      Asset::container()->add('jquery', 'js/jquery.js');
     *
     *      // Add an asset that has dependencies on other assets
     *      Asset::add('jquery', 'js/jquery.js', 'jquery-ui');
     *
     *      // Add an asset that should have attributes applied to its tags
     *      Asset::add('jquery', 'js/jquery.js', null, ['defer']);
     * </code>
     *
     * @param string $name
     * @param string|array $source
     * @param array $dependencies
     * @param array $attributes
     * @param string|null $version
     * @return AssetContainer
     */
    public function add(string $name, $source, array $dependencies = [], array $attributes = [], ?string $version = null): self
    {
        if (is_array($source)) {
            foreach ($source as $path) {
                $name = $name . '-' . md5($path);

                $this->add($name, $path, $dependencies, $attributes);
            }

            return $this;
        }

        $type = File::extension($source) == 'css' ? 'style' : 'script';

        // Remove unnecessary slashes from internal path.
        if (!preg_match('|^//|', $source)) {
            $source = ltrim($source, '/');
        }

        if ($version) {
            $source .= '?v=' . $version;
        }

        return $this->$type($name, $source, $dependencies, $attributes);
    }

    /**
     * Add an asset to the container using the path.
     *
     * The same `add` but usePath() before to add.
     *
     * <code>
     *      // Add an asset to the container
     *      Asset::container()->addUsingPath('jquery', 'js/jquery.js');
     *
     *      // Add an asset that has dependencies on other assets
     *      Asset::addUsingPath('jquery', 'js/jquery.js', 'jquery-ui');
     *
     *      // Add an asset that should have attributes applied to its tags
     *      Asset::addUsingPath('jquery', 'js/jquery.js', null, ['defer']);
     * </code>
     *
     * @param string $name
     * @param string|array $source
     * @param array $dependencies
     * @param array $attributes
     * @param string|null $version
     * @return AssetContainer
     */

    public function addUsingPath(string $name, $source, array $dependencies = [], array $attributes = [], ?string $version = null): self
    {
        return $this
            ->usePath()
            ->add($name, $source, $dependencies, $attributes, $version);
    }

    /**
     * @param string|array $name
     * @return $this
     */
    public function remove($name): self
    {
        if (!is_array($name)) {
            $name = [$name];
        }

        foreach ($name as $item) {
            foreach ($this->assets as $typeKey => $type) {
                foreach ($type as $assetKey => $asset) {
                    if ($assetKey == $item) {
                        Arr::forget($this->assets, $typeKey . '.' . $assetKey);
                        break;
                    }
                }
            }
        }

        return $this;
    }

    /**
     * @param string $name
     * @return array
     */
    public function get(string $name): array
    {
        foreach ($this->assets as $type) {
            foreach ($type as $assetKey => $asset) {
                if ($assetKey == $name) {
                    return $asset;
                }
            }
        }

        return [];
    }

    /**
     * Write a script to the container.
     *
     * @param string $name
     * @param string $source
     * @param array $dependencies
     * @return AssetContainer
     */
    public function writeScript(string $name, string $source, array $dependencies = []): self
    {
        $source = '<script>' . $source . '</script>';

        return $this->write($name, 'script', $source, $dependencies);
    }

    /**
     * Write a content to the container.
     *
     * @param string $name
     * @param string $type
     * @param string $source
     * @param array $dependencies
     * @return AssetContainer
     */
    protected function write(string $name, string $type, string $source, array $dependencies = []): self
    {
        $types = [
            'script' => 'script',
            'style'  => 'style',
            'js'     => 'script',
            'css'    => 'style',
        ];

        if (array_key_exists($type, $types)) {
            $type = $types[$type];

            $this->register($type, $name, $source, $dependencies, []);
        }

        return $this;
    }

    /**
     * Add an asset to the array of registered assets.
     *
     * @param string $type
     * @param string $name
     * @param string|array $source
     * @param array $dependencies
     * @param array $attributes
     * @return void
     */
    protected function register(string $type, string $name, $source, array $dependencies, array $attributes)
    {
        $this->assets[$type][$name] = compact('source', 'dependencies', 'attributes');
    }

    /**
     * Write a style to the container.
     *
     * @param string $name
     * @param string $source
     * @param array $dependencies
     * @return AssetContainer
     */
    public function writeStyle(string $name, string $source, array $dependencies = []): self
    {
        $source = '<style>' . $source . '</style>';

        return $this->write($name, 'style', $source, $dependencies);
    }

    /**
     * Write a content without tag wrapper.
     *
     * @param string $name
     * @param string $source
     * @param array $dependencies
     * @return AssetContainer
     */
    public function writeContent(string $name, string $source, array $dependencies = []): self
    {
        return $this->write($name, 'script', $source, $dependencies);
    }

    /**
     * Add a CSS file to the registered assets.
     *
     * @param string $name
     * @param string $source
     * @param array $dependencies
     * @param array $attributes
     * @return AssetContainer
     */
    public function style(string $name, string $source, array $dependencies = [], array $attributes = []): self
    {
        if (!array_key_exists('media', $attributes)) {
            $attributes['media'] = 'all';
        }

        // Prepend path to theme.
        if ($this->isUsePath()) {
            $source = $this->evaluatePath($this->getCurrentPath() . $source);

            // Reset using path.
            $this->usePath(false);
        }

        $this->register('style', $name, $source, $dependencies, $attributes);

        return $this;
    }

    /**
     * Add a CSS file to the registered assets using the path.
     *
     * @param string $name
     * @param string $source
     * @param array $dependencies
     * @param array $attributes
     * @return AssetContainer
     */
    public function styleUsingPath(string $name, string $source, array $dependencies = [], array $attributes = []): self
    {
        return $this->usePath()->style($name, $source, $dependencies, $attributes);
    }

    /**
     * Check using theme path.
     *
     * @return boolean
     */
    public function isUsePath(): bool
    {
        return $this->usePath;
    }

    /**
     * Evaluate path to current theme or force use theme.
     *
     * @param string $source
     * @return string
     */
    protected function evaluatePath(string $source): string
    {
        static $theme;

        // Make theme to use few features.
        if (!$theme) {
            $theme = app('theme');
        }

        $currentTheme = ThemeFacade::getThemeName();

        // Switch path to another theme.
        if (!is_bool($this->usePath) && $theme->exists($this->usePath)) {
            $source = str_replace($currentTheme, $this->usePath, $source);
        }

        $publicThemeName = ThemeFacade::getPublicThemeName();

        if ($publicThemeName != $currentTheme) {
            $source = str_replace($currentTheme, $publicThemeName, $source);
        }

        return $source;
    }

    /**
     * Force to use a theme path.
     *
     * @param boolean $use
     * @return AssetContainer
     */
    public function usePath(bool $use = true): self
    {
        $this->usePath = $use;

        return $this;
    }

    /**
     * Add a JavaScript file to the registered assets.
     *
     * @param string $name
     * @param string $source
     * @param array $dependencies
     * @param array $attributes
     * @return AssetContainer
     */
    public function script(string $name, string $source, array $dependencies = [], array $attributes = []): self
    {
        // Prepend path to theme.
        if ($this->isUsePath()) {
            $source = $this->evaluatePath($this->getCurrentPath() . $source);

            // Reset using path.
            $this->usePath(false);
        }

        $this->register('script', $name, $source, $dependencies, $attributes);

        return $this;
    }

    /**
     * Add a JavaScript file to the registered assets using the path.
     *
     * @param string $name
     * @param string $source
     * @param array $dependencies
     * @param array $attributes
     * @return AssetContainer
     */
    public function scriptUsingPath(string $name, string $source, array $dependencies = [], array $attributes = []): self
    {
        return $this->usePath()->script($name, $source, $dependencies, $attributes);
    }

    /**
     * Get the links to all the registered CSS assets.
     *
     * @return  string
     * @throws Exception
     */
    public function styles(): string
    {
        return $this->group('style');
    }

    /**
     * Get all the registered assets for a given type / group.
     *
     * @param string $group
     * @return string
     * @throws Exception
     */
    protected function group(string $group): string
    {
        if (!isset($this->assets[$group]) || count($this->assets[$group]) == 0) {
            return '';
        }

        $assets = '';

        foreach (array_keys($this->arrange($this->assets[$group])) as $name) {
            $assets .= $this->asset($group, $name);
        }

        return $assets;
    }

    /**
     * Sort and retrieve assets based on their dependencies
     *
     * @param array $assets
     * @return  array
     * @throws Exception
     */
    protected function arrange(array $assets): array
    {
        [$original, $sorted] = [$assets, []];

        while (count($assets) > 0) {
            foreach ($assets as $asset => $value) {
                $this->evaluateAsset($asset, $value, $original, $sorted, $assets);
            }
        }

        return $sorted;
    }

    /**
     * Evaluate an asset and its dependencies.
     *
     * @param string $asset
     * @param string|null|array $value
     * @param array $original
     * @param array $sorted
     * @param array $assets
     * @return void
     * @throws Exception
     */
    protected function evaluateAsset(string $asset, $value, array $original, array &$sorted, array &$assets)
    {
        // If the asset has no more dependencies, we can add it to the sorted list
        // and remove it from the array of assets. Otherwise, we will not verify
        // the asset's dependencies and determine if they've been sorted.
        if (count($assets[$asset]['dependencies']) == 0) {
            $sorted[$asset] = $value;

            unset($assets[$asset]);
        } else {
            foreach ($assets[$asset]['dependencies'] as $key => $dependency) {
                if (!$this->dependencyIsValid($asset, $dependency, $original, $assets)) {
                    unset($assets[$asset]['dependencies'][$key]);

                    continue;
                }

                // If the dependency has not yet been added to the sorted list, we can not
                // remove it from this asset's array of dependencies. We'll try again on
                // the next trip through the loop.
                if (!isset($sorted[$dependency])) {
                    continue;
                }

                unset($assets[$asset]['dependencies'][$key]);
            }
        }
    }

    /**
     * Verify that an asset's dependency is valid.
     * A dependency is considered valid if it exists, is not a circular reference, and is
     * not a reference to the owning asset itself. If the dependency doesn't exist, no
     * error or warning will be given. For the other cases, an exception is thrown.
     *
     * @param string $asset
     * @param string $dependency
     * @param array $original
     * @param array $assets
     *
     * @return bool
     * @throws Exception
     */
    protected function dependencyIsValid(string $asset, string $dependency, array $original, array $assets): bool
    {
        if (!isset($original[$dependency])) {
            return false;
        } elseif ($dependency === $asset) {
            throw new Exception('Asset [' . $asset . '] is dependent on itself.');
        } elseif (isset($assets[$dependency]) && in_array($asset, $assets[$dependency]['dependencies'])) {
            throw new Exception('Assets [' . $asset . '] and [' . $dependency . '] have a circular dependency.');
        }

        return true;
    }

    /**
     * Get the HTML link to a registered asset.
     *
     * @param string $group
     * @param string $name
     * @return string
     */
    protected function asset(string $group, string $name): ?string
    {
        if (!isset($this->assets[$group][$name])) {
            return '';
        }

        $asset = $this->assets[$group][$name];

        // If the bundle source is not a complete URL, we will go ahead and prepend
        // the bundle's asset path to the source provided with the asset. This will
        // ensure that we attach the correct path to the asset.
        if (filter_var($asset['source'], FILTER_VALIDATE_URL) === false) {
            $asset['source'] = $this->path($asset['source']);
        }

        // If source is not a path to asset, render without wrap a HTML.
        if (strpos($asset['source'], '<') !== false) {
            return $asset['source'];
        }

        // This line fixing config path.
        $asset['source'] = $this->configAssetUrl($asset['source']);

        return $this->html($group, $asset['source'], $asset['attributes']);
    }

    /**
     * Returns the full-path for an asset.
     *
     * @param string $source
     * @return string
     */
    public function path(string $source): string
    {
        return $source;
    }

    /**
     * Render asset as HTML.
     *
     * @param string $group
     * @param string $source
     * @param array $attributes
     * @return string
     */
    public function html(string $group, string $source, array $attributes): ?string
    {
        switch ($group) {
            case 'script':
                $attributes['src'] = $source;

                return '<script' . $this->attributes($attributes) . '></script>' . PHP_EOL;
            case 'style':
                $defaults = ['media' => 'all', 'type' => 'text/css', 'rel' => 'stylesheet'];

                $attributes = $attributes + $defaults;

                $attributes['href'] = $source;

                return '<link' . $this->attributes($attributes) . '>' . PHP_EOL;
        }

        return null;
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     * @return string
     */
    public function attributes(array $attributes): string
    {
        $html = [];

        // For numeric keys we will assume that the key and the value are the same
        // as this will convert HTML attributes such as "required" to a correct
        // form like required="required" instead of using incorrect numeric.
        foreach ($attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (!empty($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string|null $value
     * @return string
     */
    protected function attributeElement(string $key, ?string $value): ?string
    {
        if (is_numeric($key)) {
            $key = $value;
        }

        if (!empty($value)) {
            return $key . '="' . e($value) . '"';
        }

        return null;
    }

    /**
     * @param string $group
     * @return array
     * @throws Exception
     */
    public function getAssets(string $group): array
    {
        if (!isset($this->assets[$group])) {
            return [];
        }

        $assets = [];
        foreach (array_keys($this->arrange($this->assets[$group])) as $name) {
            $assets[] = $this->assetUrl($group, $name);
        }

        return $assets;
    }

    /**
     * @param string $group
     * @param string $name
     * @return string
     */
    protected function assetUrl(string $group, string $name): string
    {
        if (!isset($this->assets[$group][$name])) {
            return '';
        }

        $asset = $this->assets[$group][$name];

        // If the bundle source is not a complete URL, we will go ahead and prepend
        // the bundle's asset path to the source provided with the asset. This will
        // ensure that we attach the correct path to the asset.
        if (filter_var($asset['source'], FILTER_VALIDATE_URL) === false) {
            $asset['source'] = $this->path($asset['source']);
        }

        // If source is not a path to asset, render without wrap an HTML.
        if (strpos($asset['source'], '<') !== false) {
            return $asset['source'];
        }

        return $this->configAssetUrl($asset['source']);
    }

    /**
     * Get the links to all the registered JavaScript assets.
     *
     * @return  string
     * @throws Exception
     */
    public function scripts(): string
    {
        return $this->group('script');
    }
}
