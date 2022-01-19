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

        $td = Config::TEXTDOMAINE;

        $labels = array(
            'name'                       => _x( 'Villes', 'Taxonomy General Name', $td ),
            'singular_name'              => _x( 'Ville', 'Taxonomy Singular Name', $td ),
            'menu_name'                  => __( 'Villes', $td ),
            'all_items'                  => __( 'Tous les villes', $td ),
            'parent_item'                => __( 'Ville parent:', $td ),
            'parent_item_colon'          => __( 'Ville parent:', $td ),
            'new_item_name'              => __( 'Nouvelle ville', $td ),
            'add_new_item'               => __( 'Ajouter un nouvelle ville', $td ),
            'edit_item'                  => __( 'Modifier une ville', $td ),
            'update_item'                => __( 'Mettre à jour la ville', $td ),
            'view_item'                  => __( 'Voir la ville', $td ),
            'separate_items_with_commas' => __( 'Séparé les villes avec une virgule', $td ),
            'add_or_remove_items'        => __( 'Ajouter ou retirer des villes', $td ),
            'choose_from_most_used'      => __( 'Choisir parmi les plus populaires', $td ),
            'popular_items'              => __( 'Villes populaires', $td ),
            'search_items'               => __( 'Rechercher de villes', $td ),
            'not_found'                  => __( 'Aucune ville', $td ),
            'no_terms'                   => __( 'Aucune ville', $td ),
            'items_list'                 => __( 'Liste de villes', $td ),
            'items_list_navigation'      => __( 'Menu de la liste de villes', $td ),
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
            /* __("Longueuil", $td ),
            __("St-Hubert", $td ),
            __("Greenfield Park", $td ),
            __("Lemoyne", $td ),
            __("Ste-Hyacinthe", $td ),
            __("Delson", $td ),
            __("Ste-Julie", $td ),
            __("Boucherville", $td ), */
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args,
            "terms"     => $terms
        );
    }

}