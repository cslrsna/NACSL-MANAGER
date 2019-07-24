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

        $labels = array(
            'name'                  => _x( 'Gestionnaire des postes de services du CSL de Narcotiques Anonymes', 'Post Type General Name', 'nacsl' ),
            'singular_name'         => _x( 'Poste de service', 'Post Type Singular Name', 'nacsl' ),
            'menu_name'             => __( 'Services', 'nacsl' ),
            'name_admin_bar'        => __( 'Postes de services', 'nacsl' ),
            'archives'              => __( 'Archives des postes de services', 'nacsl' ),
            'attributes'            => __( 'Attributs du poste de service', 'nacsl' ),
            'parent_item_colon'     => __( 'Groupe parent:', 'nacsl' ),
            'all_items'             => __( 'Tous les postes de services', 'nacsl' ),
            'add_new_item'          => __( 'Ajouter un poste de service', 'nacsl' ),
            'add_new'               => __( 'Ajouter un poste de service', 'nacsl' ),
            'new_item'              => __( 'Nouveau poste de service', 'nacsl' ),
            'edit_item'             => __( 'Modifier un poste de service', 'nacsl' ),
            'update_item'           => __( 'Mettre à jour le poste de service', 'nacsl' ),
            'view_item'             => __( 'Voir le poste de service', 'nacsl' ),
            'view_items'            => __( 'Voir les postes de services', 'nacsl' ),
            'search_items'          => __( 'Rechercher un poste de service', 'nacsl' ),
            'not_found'             => __( 'Aucun poste de service', 'nacsl' ),
            'not_found_in_trash'    => __( 'Aucun groupe dans la corbeille', 'nacsl' ),
            'featured_image'        => __( 'Images du poste de service', 'nacsl' ),
            'set_featured_image'    => __( 'Attribuer une image au poste de service', 'nacsl' ),
            'remove_featured_image' => __( 'Retirer l\'image du poste de service', 'nacsl' ),
            'use_featured_image'    => __( 'Utiliser l\'image du poste de service', 'nacsl' ),
            'insert_into_item'      => __( 'Insérer dans un poste de service', 'nacsl' ),
            'uploaded_to_this_item' => __( 'Téléverser au poste de service', 'nacsl' ),
            'items_list'            => __( 'Liste des postes de services', 'nacsl' ),
            'items_list_navigation' => __( 'Liste des postes de services', 'nacsl' ),
            'filter_items_list'     => __( 'Filtrer la liste de postes de services', 'nacsl' ),
        );

        $rewrite = array(
            'slug'                  => 'services',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );

        $args = array(
            'label'                 => __( 'Poste de service', 'nacsl' ),
            'description'           => __( 'Registre des postes de services pour réunions de Narcotiques Anonymes.', 'nacsl' ),
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