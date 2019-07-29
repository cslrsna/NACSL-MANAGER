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
            'name'                  => _x( 'Gestionnaire des groupes du CSL de Narcotiques Anonymes', 'Post Type General Name', 'nacsl' ),
            'singular_name'         => _x( 'Groupe', 'Post Type Singular Name', 'nacsl' ),
            'menu_name'             => __( 'Groupes', 'nacsl' ),
            'name_admin_bar'        => __( 'Groupes', 'nacsl' ),
            'archives'              => __( 'Archives des groupes', 'nacsl' ),
            'attributes'            => __( 'Attributs du groupe', 'nacsl' ),
            'parent_item_colon'     => __( 'Groupe parent:', 'nacsl' ),
            'all_items'             => __( 'Tous les groupes', 'nacsl' ),
            'add_new_item'          => __( 'Ajouter un groupe', 'nacsl' ),
            'add_new'               => __( 'Ajouter un groupe', 'nacsl' ),
            'new_item'              => __( 'Nouveau groupe', 'nacsl' ),
            'edit_item'             => __( 'Modifier un groupe', 'nacsl' ),
            'update_item'           => __( 'Mettre à jour le groupe', 'nacsl' ),
            'view_item'             => __( 'Voir le groupe', 'nacsl' ),
            'view_items'            => __( 'Voir les groupes', 'nacsl' ),
            'search_items'          => __( 'Rechercher un groupe', 'nacsl' ),
            'not_found'             => __( 'Aucun groupe', 'nacsl' ),
            'not_found_in_trash'    => __( 'Aucun groupe dans la corbeille', 'nacsl' ),
            'featured_image'        => __( 'Images du groupe', 'nacsl' ),
            'set_featured_image'    => __( 'Attribuer une image au groupe', 'nacsl' ),
            'remove_featured_image' => __( 'Retirer l\'image du groupe', 'nacsl' ),
            'use_featured_image'    => __( 'Utiliser l\'image du groupe', 'nacsl' ),
            'insert_into_item'      => __( 'Insérer dans un groupe', 'nacsl' ),
            'uploaded_to_this_item' => __( 'Téléverser au groupe', 'nacsl' ),
            'items_list'            => __( 'Liste des groupes', 'nacsl' ),
            'items_list_navigation' => __( 'Liste des groupes', 'nacsl' ),
            'filter_items_list'     => __( 'Filtrer la liste de groupes', 'nacsl' ),
        );

        $rewrite = array(
            'slug'                  => 'groupes',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );

        $args = array(
            'label'                 => __( 'Groupe', 'nacsl' ),
            'description'           => __( 'Registre des groupes pour réunions de Narcotiques Anonymes.', 'nacsl' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'            => array('category'),
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
