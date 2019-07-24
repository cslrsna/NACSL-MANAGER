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
abstract class TxVilles implements CustomsDataInterface
{

    private static $_name = "";

    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::$_name;
    }

    /**
     */
    public static function setName(): void
    {
        self::$_name = strtolower(Config::getInstance()->getPrefix() . "tx-villes");
    }


    /**
     * @return array
     */
    public static function data(): array
    {
        self::setName();

        $labels = array(
            'name'                       => _x( 'Villes', 'Taxonomy General Name', 'nacsl' ),
            'singular_name'              => _x( 'Ville', 'Taxonomy Singular Name', 'nacsl' ),
            'menu_name'                  => __( 'Villes', 'nacsl' ),
            'all_items'                  => __( 'Tous les villes', 'nacsl' ),
            'parent_item'                => __( 'Ville parent:', 'nacsl' ),
            'parent_item_colon'          => __( 'Ville parent:', 'nacsl' ),
            'new_item_name'              => __( 'Nouvelle ville', 'nacsl' ),
            'add_new_item'               => __( 'Ajouter un nouvelle ville', 'nacsl' ),
            'edit_item'                  => __( 'Modifier une ville', 'nacsl' ),
            'update_item'                => __( 'Mettre à jour la ville', 'nacsl' ),
            'view_item'                  => __( 'Voir la ville', 'nacsl' ),
            'separate_items_with_commas' => __( 'Séparé les villes avec une virgule', 'nacsl' ),
            'add_or_remove_items'        => __( 'Ajouter ou retirer des villes', 'nacsl' ),
            'choose_from_most_used'      => __( 'Choisir parmi les plus populaires', 'nacsl' ),
            'popular_items'              => __( 'Villes populaires', 'nacsl' ),
            'search_items'               => __( 'Rechercher de villes', 'nacsl' ),
            'not_found'                  => __( 'Aucune ville', 'nacsl' ),
            'no_terms'                   => __( 'Aucune ville', 'nacsl' ),
            'items_list'                 => __( 'Liste de villes', 'nacsl' ),
            'items_list_navigation'      => __( 'Menu de la liste de villes', 'nacsl' ),
        );
        $rewrite = array(
            'slug'                       => 'villes',
            'with_front'                 => true,
            'hierarchical'               => false,
        );
        $args = array(
            'labels'                    => $labels,
            'hierarchical'              => false,
            'public'                    => true,
            'show_ui'                   => true,
            'show_admin_column'         => true,
            'show_in_nav_menus'         => true,
            'show_in_menu'              => true,
            'show_tagcloud'             => true,
            'query_var'                 => 'villes',
            'rewrite'                   => $rewrite,
            'show_in_rest'              => true,
        );
        $terms = array(
            __("Longueuil", "nacsl"),
            __("St-Hubert", "nacsl"),
            __("Greenfield Park", "nacsl"),
            __("Lemoyne", "nacsl"),
            __("Ste-Hyacinthe", "nacsl"),
            __("Delson", "nacsl"),
            __("Ste-Julie", "nacsl"),
            __("Boucherville", "nacsl"),
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args,
            "terms"     => $terms
        );
    }

}