<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/21/19
 * Time: 11:29 PM
 */

namespace nacsl\App\Models;

use nacsl\App\Config;
use nacsl\App\Helpers\CustomsDataInterface;

/**
 * Class TxFormats
 * @package nacsl\App\Models
 */
class TxJours implements CustomsDataInterface
{

    private static $_name = "";

    /**
     * @return string
     */
    public static function getName(): string
    {
        return static::$_name;
    }

    /**
     */
    public static function setName(): void
    {
        self::$_name = strtolower(Config::getInstance()->getPrefix() . "tx-Jours");
    }

    /**
     * @return array
     */
    public static function data(): array
    {
        self::setName();

        $labels = array(
            'name'                       => _x( 'Jours des réunions', 'Taxonomy General Name', 'nacsl' ),
            'singular_name'              => _x( 'Jour de réunion', 'Taxonomy Singular Name', 'nacsl' ),
            'menu_name'                  => __( 'Jours des réunions', 'nacsl' ),
            'all_items'                  => __( 'Tous les jours', 'nacsl' ),
            'parent_item'                => __( 'Jour parent:', 'nacsl' ),
            'parent_item_colon'          => __( 'Jour parent:', 'nacsl' ),
            'new_item_name'              => __( 'Nouveau Jour', 'nacsl' ),
            'add_new_item'               => __( 'Ajouter un nouveau Jour', 'nacsl' ),
            'edit_item'                  => __( 'Modifier un Jour', 'nacsl' ),
            'update_item'                => __( 'Mettre à jour le Jour', 'nacsl' ),
            'view_item'                  => __( 'Voir le Jour', 'nacsl' ),
            'separate_items_with_commas' => __( 'Séparé les Jours avec une virgule', 'nacsl' ),
            'add_or_remove_items'        => __( 'Ajouter ou retirer des Jours', 'nacsl' ),
            'choose_from_most_used'      => __( 'Choisir parmi les plus populaires', 'nacsl' ),
            'popular_items'              => __( 'Jours populaires', 'nacsl' ),
            'search_items'               => __( 'Rechercher de Jours', 'nacsl' ),
            'not_found'                  => __( 'Jour introuvable', 'nacsl' ),
            'no_terms'                   => __( 'Aucun Jour', 'nacsl' ),
            'items_list'                 => __( 'Liste de Jours', 'nacsl' ),
            'items_list_navigation'      => __( 'Menu de la liste de Jours', 'nacsl' ),
        );
        $rewrite = array(
            'slug'                       => 'jours',
            'with_front'                 => true,
            'hierarchical'               => false,
        );
        $args = array(
            'labels'            => $labels,
            'hierarchical'      => false,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_in_menu'      => true,
            'show_tagcloud'     => true,
            'query_var'         => 'jours',
            'rewrite'           => $rewrite,
            'show_in_rest'      => true,
//            'show_in_quick_edit'=> false,
//            'meta_box_cb'       => false
        );
        $terms = array(
            __("Dimanche", "nacsl"),
            __("Lundi", "nacsl"),
            __("Mardi", "nacsl"),
            __("Mercredi", "nacsl"),
            __("Jeudi", "nacsl"),
            __("Vendredi", "nacsl"),
            __("Samedi", "nacsl"),
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args,
            "terms"     => $terms
        );
    }

}