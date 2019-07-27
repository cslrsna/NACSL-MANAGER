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
use nacsl\App\Models\CptGroupes;
use nacsl\App\Models\CptServices;
use nacsl\App\Models\CptSousComites;
use nacsl\App\Models\TxFormats;
use nacsl\App\Models\TxJours;
use nacsl\App\Models\TxVilles;
use nacsl\Main;
use nacsl\Wordpress\CustomMetaboxs;
use nacsl\Wordpress\CustomPostTypes;
use nacsl\Wordpress\CustomTaxonomies;

if ( ! defined( 'ABSPATH' ) ) die( 'No direct access :)' );

$nacslConfig = Config::getInstance();
require_once ABSPATH . "wp-admin/includes/plugin.php";
$nacslConfig->init( __FILE__ );

$nacsl = Main::getInstance();
$nacsl->execute(
    array(
        new CustomPostTypes( CptGroupes::data() ),
        new CustomPostTypes( CptSousComites::data() ),
        new CustomPostTypes( CptServices::data() ),

        new CustomTaxonomies( CptGroupes::getName(), TxFormats::data() ),
        new CustomTaxonomies( array( CptGroupes::getName(), CptSousComites::getName() ), TxJours::data() ),
        new CustomTaxonomies( CptGroupes::getName(), TxVilles::data() ),

        //add_meta_box('id_ma_meta', 'Ma metabox', 'ma_meta_function', 'post', 'side', 'high');
        new CustomMetaboxs(
            'id_ma_meta',
            'Ma metabox',
            CptGroupes::getName(),
            'normal',
            'high',
            array(
                [
                    'label' => "Mon champ",
                    'key'   => "_ma_valeur",
                    'type'  => "text",
                    'name'  => "mon_champ",
                ],
                [
                    'label' => "Mon deuxieme champ",
                    'key'   => "_mon_autre_valeur",
                    'type'  => "text",
                    'name'  => "mon_autre_champ",
                ],
            )
        )
    )
);
