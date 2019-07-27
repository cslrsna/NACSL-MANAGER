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

abstract class CptServices implements CustomsDataInterface
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
        self::$_name = strtolower(Config::getInstance()->getPrefix() . "cpt-Services");
    }


    /**
     * @return array
     */
    public static function data(): array
    {

        self::setName();

        $td = Config::TEXTDOMAINE;

        $labels = array(
            'name'                  => _x( 'Gestionnaire des postes de services du CSL de Narcotiques Anonymes', 'Post Type General Name', $td ),
            'singular_name'         => _x( 'Poste de service', 'Post Type Singular Name', $td ),
            'menu_name'             => __( 'Services', $td ),
            'name_admin_bar'        => __( 'Postes de services', $td ),
            'archives'              => __( 'Archives des postes de services', $td ),
            'attributes'            => __( 'Attributs du poste de service', $td ),
            'parent_item_colon'     => __( 'Groupe parent:', $td ),
            'all_items'             => __( 'Tous les postes de services', $td ),
            'add_new_item'          => __( 'Ajouter un poste de service', $td ),
            'add_new'               => __( 'Ajouter un poste de service', $td ),
            'new_item'              => __( 'Nouveau poste de service', $td ),
            'edit_item'             => __( 'Modifier un poste de service', $td ),
            'update_item'           => __( 'Mettre à jour le poste de service', $td ),
            'view_item'             => __( 'Voir le poste de service', $td ),
            'view_items'            => __( 'Voir les postes de services', $td ),
            'search_items'          => __( 'Rechercher un poste de service', $td ),
            'not_found'             => __( 'Aucun poste de service', $td ),
            'not_found_in_trash'    => __( 'Aucun groupe dans la corbeille', $td ),
            'featured_image'        => __( 'Images du poste de service', $td ),
            'set_featured_image'    => __( 'Attribuer une image au poste de service', $td ),
            'remove_featured_image' => __( 'Retirer l\'image du poste de service', $td ),
            'use_featured_image'    => __( 'Utiliser l\'image du poste de service', $td ),
            'insert_into_item'      => __( 'Insérer dans un poste de service', $td ),
            'uploaded_to_this_item' => __( 'Téléverser au poste de service', $td ),
            'items_list'            => __( 'Liste des postes de services', $td ),
            'items_list_navigation' => __( 'Liste des postes de services', $td ),
            'filter_items_list'     => __( 'Filtrer la liste de postes de services', $td ),
        );

        $rewrite = array(
            'slug'                  => 'services',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );

        $args = array(
            'label'                 => __( 'Poste de service', $td ),
            'description'           => __( 'Registre des postes de services pour réunions de Narcotiques Anonymes.', $td ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => -1,
            'menu_icon'             => Config::getInstance()->getUrls('img') . 'logo-na.png',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'post',
            'show_in_rest'          => false,
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args
        );
    }

}