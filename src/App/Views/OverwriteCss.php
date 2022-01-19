<?php
namespace nacsl\App\Views;

use nacsl\Wordpress\HooksFrontInterfaces;

/** @package nacsl\App\Views */
class OverwriteCss implements HooksFrontInterfaces
{

    public function style()
    {
        wp_enqueue_style( 'style', \plugin_dir_url(__DIR__) . "../Stylesheets/overwrite.css" );
    }

    public function hook() 
    {        
        add_action( 'wp_enqueue_scripts', array($this, 'style') );
    }
    
}
