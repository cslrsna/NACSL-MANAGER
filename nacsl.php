<?php

/*
Plugin Name: NACSL Manager
Plugin URI: http://github.com/cslrsna
Description: A brief description of the Plugin.
Version: 2.0
Author: webmestre
Author URI: http://cslrsna.org
Text Domain: nacsl
Domain Path: /languages
License: GPL3
*/

require "vendor/autoload.php";

use nacsl\App\Config;
use nacsl\App\Controllers\CptGroupController;
use nacsl\App\Helpers\AddScript;
use nacsl\App\Helpers\CustomsShortcuts;
use nacsl\App\Helpers\ModalConsole;
use nacsl\App\Helpers\PagesCorrections;
use nacsl\App\Models\CptActivites;
use nacsl\App\Models\CptGroupes;
use nacsl\App\Models\CptSousComites;
use nacsl\App\Models\TxFormats;
use nacsl\App\Models\TxJours;
use nacsl\App\Models\TxVilles;
use nacsl\App\Views\CptGroupView;
use nacsl\App\Views\OverwriteCss;
use nacsl\Main;
use nacsl\Wordpress\CustomPostTypes;
use nacsl\Wordpress\CustomTaxonomies;
use nacsl\App\Views\Popups\CovidPopup;

if ( ! defined( 'ABSPATH' ) ) die( 'No direct access' );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active('acfcond.php') )
    deactivate_plugins('acfcond.php');
if ( is_plugin_active('NACSL-PATCH/covid_popup.php') )
    deactivate_plugins('NACSL-PATCH/covid_popup.php');

//date_default_timezone_set('America/New_York');

$nacslConfig = Config::getInstance();

require_once ABSPATH . "wp-admin/includes/plugin.php";
$nacslConfig->init( __FILE__ );

$nacsl = Main::getInstance();
$nacsl->execute(
    array(

        new CustomPostTypes( CptGroupes::data() ),
        new CustomPostTypes( CptSousComites::data() ),
        new CustomPostTypes( CptActivites::data() ),

        new CustomTaxonomies( CptGroupes::getName(), TxFormats::data() ),
        new CustomTaxonomies( array( CptGroupes::getName(), CptSousComites::getName() ), TxJours::data() ),
        new CustomTaxonomies( CptGroupes::getName(), TxVilles::data() ),

        new AddScript(),
        new PagesCorrections(),
        new CustomsShortcuts(),
        new CptGroupView(),
        new CptGroupController(),
        new OverwriteCss()
        //new CovidPopup()

//        new ModalConsole()

        //TODO: metabox hooks
    )
);
