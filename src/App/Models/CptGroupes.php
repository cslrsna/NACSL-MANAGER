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
        
        $td = Config::TEXTDOMAINE;

        $labels = array(
            'name'                  => _x( 'Gestionnaire des groupes du CSL de Narcotiques Anonymes', 'Post Type General Name', $td ),
            'singular_name'         => _x( 'Groupe', 'Post Type Singular Name', $td ),
            'menu_name'             => __( 'Groupes', $td ),
            'name_admin_bar'        => __( 'Groupes', $td ),
            'archives'              => __( 'Archives des groupes', $td ),
            'attributes'            => __( 'Attributs du groupe', $td ),
            'parent_item_colon'     => __( 'Groupe parent:', $td ),
            'all_items'             => __( 'Tous les groupes', $td ),
            'add_new_item'          => __( 'Ajouter un groupe', $td ),
            'add_new'               => __( 'Ajouter un groupe', $td ),
            'new_item'              => __( 'Nouveau groupe', $td ),
            'edit_item'             => __( 'Modifier un groupe', $td ),
            'update_item'           => __( 'Mettre à jour le groupe', $td ),
            'view_item'             => __( 'Voir le groupe', $td ),
            'view_items'            => __( 'Voir les groupes', $td ),
            'search_items'          => __( 'Rechercher un groupe', $td ),
            'not_found'             => __( 'Aucun groupe', $td ),
            'not_found_in_trash'    => __( 'Aucun groupe dans la corbeille', $td ),
            'featured_image'        => __( 'Images du groupe', $td ),
            'set_featured_image'    => __( 'Attribuer une image au groupe', $td ),
            'remove_featured_image' => __( 'Retirer l\'image du groupe', $td ),
            'use_featured_image'    => __( 'Utiliser l\'image du groupe', $td ),
            'insert_into_item'      => __( 'Insérer dans un groupe', $td ),
            'uploaded_to_this_item' => __( 'Téléverser au groupe', $td ),
            'items_list'            => __( 'Liste des groupes', $td ),
            'items_list_navigation' => __( 'Liste des groupes', $td ),
            'filter_items_list'     => __( 'Filtrer la liste de groupes', $td ),
        );

        $rewrite = array(
            'slug'                  => 'groupes',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );

        $args = array(
            'label'                 => __( 'Groupe', $td ),
            'description'           => __( 'Registre des groupes pour réunions de Narcotiques Anonymes.', $td ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
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