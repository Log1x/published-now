<?php

/**
 * Plugin Name: Published Now
 * Plugin URI:  https://github.com/log1x/published-now
 * Description: A simple plugin adding a "Now" button when editing a publish date.
 * Version:     1.0.0
 * Author:      Brandon Nifong
 * Author URI:  https://github.com/log1x
 * Licence:     MIT
 */

add_action('init', new class
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
        add_action('admin_enqueue_scripts', function ($hook) {
            if ($hook !== 'edit.php') {
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
});
