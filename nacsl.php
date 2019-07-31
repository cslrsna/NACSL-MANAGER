<?php

/*
Plugin Name: NACSL Manager
Plugin URI: http://github.com/cslrsna
Description: A brief description of the Plugin.
Version: 1.0.1
Author: webmestre
Author URI: http://cslrsna.org
Text Domain: nacsl
Domain Path: /languages
License: GPL3
*/

require "vendor/autoload.php";

use nacsl\App\Config;
use nacsl\App\Models\CptActivites;
use nacsl\App\Models\CptGroupes;
use nacsl\App\Models\CptServices;
use nacsl\App\Models\CptSousComites;
use nacsl\App\Models\TxFormats;
use nacsl\App\Models\TxJours;
use nacsl\App\Models\TxVilles;
use nacsl\Main;
use nacsl\Wordpress\CustomPostTypes;
use nacsl\Wordpress\CustomTaxonomies;
use Walker_Nav_Menu_With_Aria;

if ( ! defined( 'ABSPATH' ) ) die( 'No direct access' );

$nacslConfig = Config::getInstance();

require_once ABSPATH . "wp-admin/includes/plugin.php";
$nacslConfig->init( __FILE__ );

$nacsl = Main::getInstance();
$nacsl->execute(
    array(
//        new BugsPatcher(),

        new CustomPostTypes( CptGroupes::data() ),
        new CustomPostTypes( CptSousComites::data() ),
        new CustomPostTypes( CptServices::data() ),
        new CustomPostTypes( CptActivites::data() ),

        new CustomTaxonomies( CptGroupes::getName(), TxFormats::data() ),
        new CustomTaxonomies( array( CptGroupes::getName(), CptSousComites::getName() ), TxJours::data() ),
        new CustomTaxonomies( CptGroupes::getName(), TxVilles::data() ),

        //TODO: metabox hooks
    )
);

if (has_nav_menu('primary')) {
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'walker'         => new Walker_Nav_Menu_With_Aria,
    ) );
}