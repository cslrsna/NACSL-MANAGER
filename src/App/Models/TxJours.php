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

        $td = Config::TEXTDOMAINE;

        $labels = array(
            'name'                       => _x( 'Jours des réunions', 'Taxonomy General Name', $td ),
            'singular_name'              => _x( 'Jour de réunion', 'Taxonomy Singular Name', $td ),
            'menu_name'                  => __( 'Jours des réunions', $td ),
            'all_items'                  => __( 'Tous les jours', $td ),
            'parent_item'                => __( 'Jour parent:', $td ),
            'parent_item_colon'          => __( 'Jour parent:', $td ),
            'new_item_name'              => __( 'Nouveau Jour', $td ),
            'add_new_item'               => __( 'Ajouter un nouveau Jour', $td ),
            'edit_item'                  => __( 'Modifier un Jour', $td ),
            'update_item'                => __( 'Mettre à jour le Jour', $td ),
            'view_item'                  => __( 'Voir le Jour', $td ),
            'separate_items_with_commas' => __( 'Séparé les Jours avec une virgule', $td ),
            'add_or_remove_items'        => __( 'Ajouter ou retirer des Jours', $td ),
            'choose_from_most_used'      => __( 'Choisir parmi les plus populaires', $td ),
            'popular_items'              => __( 'Jours populaires', $td ),
            'search_items'               => __( 'Rechercher de Jours', $td ),
            'not_found'                  => __( 'Jour introuvable', $td ),
            'no_terms'                   => __( 'Aucun Jour', $td ),
            'items_list'                 => __( 'Liste de Jours', $td ),
            'items_list_navigation'      => __( 'Menu de la liste de Jours', $td ),
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
            'show_in_menu'      => false,
            'show_tagcloud'     => true,
            'query_var'         => 'jours',
            'rewrite'           => $rewrite,
            'show_in_rest'      => true,
//            'show_in_quick_edit'=> false,
//            'meta_box_cb'       => false
        );
        $terms = array(
            __("Dimanche", $td ),
            __("Lundi", $td ),
            __("Mardi", $td ),
            __("Mercredi", $td ),
            __("Jeudi", $td ),
            __("Vendredi", $td ),
            __("Samedi", $td ),
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args,
            "terms"     => $terms
        );
    }

}