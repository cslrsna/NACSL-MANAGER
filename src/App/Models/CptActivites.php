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

abstract class CptActivites implements CustomsDataInterface
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
        self::$_name = strtolower(Config::getInstance()->getPrefix() . "cpt-Activites");
    }


    /**
     * @return array
     */
    public static function data(): array
    {

        self::setName();

        $labels = array(
            'name'                  => _x( 'Liste des activités CSLRS de Narcotiques Anonymes', 'Post Type General Name', 'nacsl' ),
            'singular_name'         => _x( 'Activité', 'Post Type Singular Name', 'nacsl' ),
            'menu_name'             => __( 'Activités', 'nacsl' ),
            'name_admin_bar'        => __( 'Activités', 'nacsl' ),
            'archives'              => __( 'Archives des activités', 'nacsl' ),
            'attributes'            => __( 'Attributs de l\'activité', 'nacsl' ),
            'parent_item_colon'     => __( 'Réunion parente:', 'nacsl' ),
            'all_items'             => __( 'Tous les activités', 'nacsl' ),
            'add_new_item'          => __( 'Ajouter une activité', 'nacsl' ),
            'add_new'               => __( 'Ajouter une activité', 'nacsl' ),
            'new_item'              => __( 'Nouvelle réunion', 'nacsl' ),
            'edit_item'             => __( 'Modifier une activité', 'nacsl' ),
            'update_item'           => __( 'Mettre à jour l\'activité', 'nacsl' ),
            'view_item'             => __( 'Voir l\'activité', 'nacsl' ),
            'view_items'            => __( 'Voir les activités', 'nacsl' ),
            'search_items'          => __( 'Rechercher une activité', 'nacsl' ),
            'not_found'             => __( 'Aucune activité', 'nacsl' ),
            'not_found_in_trash'    => __( 'Aucun réunion dans la corbeille', 'nacsl' ),
            'featured_image'        => __( 'Images de l\'activité', 'nacsl' ),
            'set_featured_image'    => __( 'Attribuer une image à l\'activité', 'nacsl' ),
            'remove_featured_image' => __( 'Retirer l\'image de l\'activité', 'nacsl' ),
            'use_featured_image'    => __( 'Utiliser l\'image de l\'activité', 'nacsl' ),
            'insert_into_item'      => __( 'Insérer dans une activité', 'nacsl' ),
            'uploaded_to_this_item' => __( 'Téléverser à l\'activité', 'nacsl' ),
            'items_list'            => __( 'Liste des activités', 'nacsl' ),
            'items_list_navigation' => __( 'Liste des activités', 'nacsl' ),
            'filter_items_list'     => __( 'Filtrer la liste de activités', 'nacsl' ),
        );

        $rewrite = array(
            'slug'                  => 'activites',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );

        $args = array(
            'label'                 => __( 'Activites', 'nacsl' ),
            'description'           => __( 'Tous les activités seront affichées sur cette page, revenez souvent pour rester informé des activitées du CSL.', 'nacsl' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail'),
            'taxonomies'            => array('category'),
            'hierarchical'          => true,
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
            'show_in_rest'          => true,
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args
        );
    }

}
