<?php

/**
 * Plugin Name: Published Now
 * Plugin URI:  https://github.com/log1x/published-now
 * Description: Add a simple publish date reset button on the Classic Editor.
 * Version:     1.0.1
 * Author:      Brandon Nifong
 * Author URI:  https://github.com/log1x
 * Licence:     MIT
 */

add_filter('plugins_loaded', new class
{
    /**
     * The plugin URI.
     *
     * @var string
     */
    protected $uri;

    /**
     * The plugin path.
     *
     * @var string
     */
    protected $path;

    /**
     * Invoke the plugin.
     *
     * @return void
     */
    public function __invoke()
    {
        $this->uri = plugin_dir_url(__FILE__) . 'public';
        $this->path = plugin_dir_path(__FILE__) . 'public';

        $this->enqueue();
    }

    /**
     * Enqueue the login scripts.
     *
     * @return void
     */
    public function enqueue()
    {
        add_filter('admin_enqueue_scripts', function ($hook) {
            if (! $this->contains($hook, [
                'edit.php',
                'post.php',
                'post-new.php'
            ])) {
                return;
            }

            wp_enqueue_script('published-now/plugin.js', $this->asset('/js/plugin.js'), ['jquery'], null, true);
        }, 100);
    }

    /**
     * Resolve the URI for an asset using the manifest.
     *
     * @return string
     */
    public function asset($asset = '', $manifest = 'mix-manifest.json')
    {
        if (! file_exists($manifest = $this->path . $manifest)) {
            return $this->uri . $asset;
        }

        $manifest = json_decode(file_get_contents($manifest), true);

        return $this->uri . ($manifest[$asset] ?? $asset);
    }

    /**
     * Determine if a given string contains a given substring.
     *
     * @param  string  $haystack
     * @param  string|string[]  $needles
     * @return bool
     */
    public function contains($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
});
