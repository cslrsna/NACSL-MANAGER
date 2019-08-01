<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 8/1/19
 * Time: 3:49 PM
 */

namespace nacsl\App\Helpers;


use nacsl\App\Config;
use nacsl\Wordpress\HooksFrontInterfaces;

class PagesCorrections implements HooksFrontInterfaces
{

    private $_config;

    public function __construct()
    {
        $this->_config = Config::getInstance();
    }

    public function addCss()
    {
        if ( ! get_permalink() == "https://cslrsna.org/reunions") {
            wp_enqueue_style(
                Config::TEXTDOMAINE . "-css-correction",
                $this->_config->getPaths('css') . "corrections.css"
            );
        }
    }

    public function hook()
    {
        add_action('wp_enqueue_scripts', array($this, 'addCss'));
    }
}