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
class TxDispo implements CustomsDataInterface
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
        self::$_name = strtolower(Config::getInstance()->getPrefix() . "tx-Dispo");
    }

    /**
     * @return array
     */
    public static function data(): array
    {
        self::setName();

        $td = Config::TEXTDOMAINE;

        $labels = array(
            'name'                       => _x( 'Disponibilité des postes de services', 'Taxonomy General Name', $td ),
            'singular_name'              => _x( 'Disponibilité', 'Taxonomy Singular Name', $td ),
            'menu_name'                  => __( 'Disponibilité', $td ),
            'all_items'                  => __( 'Tous les disponibilités', $td ),
            'parent_item'                => __( 'Disponibilité parent:', $td ),
            'parent_item_colon'          => __( 'Disponibilité parent:', $td ),
            'new_item_name'              => __( 'Nouvelle disponibilité' , $td ),
            'add_new_item'               => __( 'Ajouter une nouvelle disponibilité ', $td ),
            'edit_item'                  => __( 'Modifier une disponibilité', $td ),
            'update_item'                => __( 'Mettre à jour la disponibilité', $td ),
            'view_item'                  => __( 'Voir la disponibilité', $td ),
            'separate_items_with_commas' => __( 'Séparé les disponibilités avec une virgule', $td ),
            'add_or_remove_items'        => __( 'Ajouter ou retirer des disponibilités', $td ),
            'choose_from_most_used'      => __( 'Choisir parmi les plus populaires', $td ),
            'popular_items'              => __( 'Disponibilités populaires', $td ),
            'search_items'               => __( 'Rechercher de disponibilités ', $td ),
            'not_found'                  => __( 'Disponibilité introuvable', $td ),
            'no_terms'                   => __( 'Aucune diponibilité', $td ),
            'items_list'                 => __( 'Liste de disponibilités ', $td ),
            'items_list_navigation'      => __( 'Menu de la liste de disponibilités ', $td ),
        );
        $rewrite = array(
            'slug'                       => 'disponibilite',
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
            'query_var'         => 'dispo',
            'rewrite'           => $rewrite,
            'show_in_rest'      => true,
//            'show_in_quick_edit'=> false,
//            'meta_box_cb'       => false
        );
        $terms = array(
            __("vacant", $td ),
            __("occupé", $td ),
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args,
            "terms"     => $terms
        );
    }

}