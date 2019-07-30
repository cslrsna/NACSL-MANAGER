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

abstract class CptGroupes implements CustomsDataInterface
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
        self::$_name = strtolower(Config::getInstance()->getPrefix() . "cpt-Groupes");
    }


    /**
     * @return array
     */
    public static function data(): array
    {

        self::setName();

        $labels = array(
            'name'                  => _x( 'Gestionnaires des réunions de Narcotiques Anonymes', 'Post Type General Name', 'nacsl' ),
            'singular_name'         => _x( 'Réunion', 'Post Type Singular Name', 'nacsl' ),
            'menu_name'             => __( 'Réunions', 'nacsl' ),
            'name_admin_bar'        => __( 'Réunions', 'nacsl' ),
            'archives'              => __( 'Réunions NA', 'nacsl' ),
            'attributes'            => __( 'Attributs de la réunion', 'nacsl' ),
            'parent_item_colon'     => __( 'Réunion parente:', 'nacsl' ),
            'all_items'             => __( 'Tous les réunions', 'nacsl' ),
            'add_new_item'          => __( 'Ajouter une réunion', 'nacsl' ),
            'add_new'               => __( 'Ajouter une réunion', 'nacsl' ),
            'new_item'              => __( 'Nouvelle réunion', 'nacsl' ),
            'edit_item'             => __( 'Modifier une réunion', 'nacsl' ),
            'update_item'           => __( 'Mettre à jour la réunion', 'nacsl' ),
            'view_item'             => __( 'Voir la réunion', 'nacsl' ),
            'view_items'            => __( 'Voir les réunions', 'nacsl' ),
            'search_items'          => __( 'Rechercher une réunion', 'nacsl' ),
            'not_found'             => __( 'Aucune réunion', 'nacsl' ),
            'not_found_in_trash'    => __( 'Aucun réunion dans la corbeille', 'nacsl' ),
            'featured_image'        => __( 'Images de la réunion', 'nacsl' ),
            'set_featured_image'    => __( 'Attribuer une image à la réunion', 'nacsl' ),
            'remove_featured_image' => __( 'Retirer l\'image de la réunion', 'nacsl' ),
            'use_featured_image'    => __( 'Utiliser l\'image de la réunion', 'nacsl' ),
            'insert_into_item'      => __( 'Insérer dans une réunion', 'nacsl' ),
            'uploaded_to_this_item' => __( 'Téléverser à la réunion', 'nacsl' ),
            'items_list'            => __( 'Liste des réunions', 'nacsl' ),
            'items_list_navigation' => __( 'Liste des réunions', 'nacsl' ),
            'filter_items_list'     => __( 'Filtrer la liste de réunions', 'nacsl' ),
        );

        $rewrite = array(
            'slug'                  => 'reunions',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );

        $args = array(
            'label'                 => __( 'Groupe', 'nacsl' ),
            'description'           => __( 'Registre des groupes pour réunions de Narcotiques Anonymes.', 'nacsl' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail'),
            'taxonomies'            => array('category'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => -10,
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
